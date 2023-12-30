<?php

use App\Events\PaymentEvent;
use App\Events\UserUpdateCreditsEvent;
use App\Models\PartnerDiscount;
use App\Models\Payment;
use App\Models\ShopProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use App\Notifications\ConfirmPaymentNotification;
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationCanceled;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\NotificationEventType;




function YookassaPay(Request $request)
{

    $user = Auth::user();
    $client = getYookassaClient();
    $shopProduct = ShopProduct::findOrFail($request->shopProduct);
    $discount = PartnerDiscount::getDiscount();

    if ($shopProduct->currency_code != 'RUB'){
        $shopProduct->price = $shopProduct->price * 100;
        $shopProduct->currency_code = 'RUB';
    }

    // create a new payment
    $payment = Payment::create([
        'user_id' => $user->id,
        'payment_id' => null,
        'payment_method' => 'YooKassa',
        'type' => $shopProduct->type,
        'status' => 'open',
        'amount' => $shopProduct->quantity,
        'price' => $shopProduct->price - ($shopProduct->price * $discount / 100),
        'tax_value' => $shopProduct->getTaxValue(),
        'tax_percent' => $shopProduct->getTaxPercent(),
        'total_price' => $shopProduct->getTotalPrice(),
        'currency_code' => $shopProduct->currency_code,
        'shop_item_product_id' => $shopProduct->id,
    ]);



    try {
        $response = $client->createPayment(
            array(
                'amount' => array(
                    'value' => $shopProduct->getTotalPrice(),
                    'currency' => $shopProduct->currency_code,
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => route('store.index'),
                ),
                'capture' => true,
                'description' => 'Пополнение баланса ProtesiaN Host',
                "metadata" => array(
                    'user_id' => $payment->user_id,
                    'payment_id' => $payment->id,
                    'shop_product_id' => $payment->shop_item_product_id,
                ),
                "receipt" => array(
                    "customer" => array(
                        "full_name" => $user->name,
                        "email" => $user->email,
                    ),
                    "items" => array(
                        array(
                            "description" => "Пополнение баланса ProtesiaN Host",
                            "quantity" => "1.00",
                            "amount" => array(
                                "value" => $payment->price,
                                "currency" => $payment->currency_code
                            ),
                            "vat_code" => "1",
                            "payment_mode" => "full_payment",
                            "payment_subject" => "service"
                        )
                    )
                )
            ),
            uniqid('protesian_', true)
        );
        Redirect::to($response->getConfirmation()->getConfirmationUrl())->send();
    } catch (\Exception $ex) {
        Log::error('Yookassa Payment: ' . $ex->getMessage());
        $payment->delete();
        Redirect::route('store.index')->with('error', __('Payment failed'))->send();
        return;
    }
}

function YookassaNotification(Request $request)
{
    Log::info('YooKassa notification');
    $IPWhitelist = array(
        "185.71.76.0/27",
        "185.71.77.0/27",
        "77.75.153.0/25",
        "77.75.156.11",
        "77.75.156.35",
        "77.75.154.128/25",
        "2a02:5180::/32",
        "77.75.154.206",
        "127.0.0.1",
        "77.75.153.78",
    );
    if(!in_array($request->header('CF-Connecting-IP'), $IPWhitelist)) {
        Log::error('IP ' . $request->header('CF-Connecting-IP') . ' not in whitelist');
        return response('IP is not in whitelist', 403);
    }
    // if(!in_array($request->ip(), $IPWhitelist)) {
    //     Log::error('IP ' . $request->ip() . ' not in whitelist');
    //     return response('IP is not in whitelist', 403);
    // }


    try {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);

        $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationCanceled($requestBody);

        $client = getYookassaClient();
        $YooPayment = $client->getPaymentInfo($notification->getObject()->id);
        $metadata = $YooPayment->getMetadata()->toArray();

        $user = Auth::user();
        $user = User::findOrFail($metadata['user_id']);
        $payment = Payment::findOrFail($metadata['payment_id']);
        $shopProduct = ShopProduct::findOrFail($metadata['shop_product_id']);
        Log::info('User ID ' . $metadata['user_id']);
        Log::info('Payment ID ' . $metadata['payment_id']);
        Log::info('Payment amount ' . $YooPayment->amount->value . ' ' . $YooPayment->amount->currency);
        Log::info('Payment status ' . $YooPayment->status);

        if ($YooPayment->status === 'succeeded' && Payment::where('payment_id', $metadata['payment_id'])->count() == 0) {
            //update payment
            $payment->update([
                'status' => 'paid',
                'payment_id' => $notification->getObject()->id,
            ]);

            $user->notify(new ConfirmPaymentNotification($payment));

            event(new UserUpdateCreditsEvent($user));
            event(new PaymentEvent($user, $payment, $shopProduct));

            return response('Successfully', 200);

        }elseif($YooPayment->status === 'canceled') {
                $payment->update([
                    'status' => 'cancelled',
                    'payment_id' => $notification->getObject()->id,
                ]);
                return response('Successfully', 200);
        } else {
            return response('Internal Error', 500);
        }
    }catch (\Exception $e) {
        Log::error($e);
    }
}
function getYookassaClient()
{
    $client = new Client();
    $shopID = config("SETTINGS::PAYMENTS:YOOKASSA:SHOP_ID");
    $secretKey = config("SETTINGS::PAYMENTS:YOOKASSA:SECRET_KEY");
    $client->setAuth($shopID, $secretKey);
    return $client;
}

function getYookassaShopId()
{
    return config("SETTINGS::PAYMENTS:YOOKASSA:SHOP_ID");
}

function getYookassaSecretKey()
{
    return config("SETTINGS::PAYMENTS:YOOKASSA:SECRET_KEY");
}
