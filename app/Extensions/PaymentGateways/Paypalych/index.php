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
use App\Extensions\PaymentGateways\Paypalych\Paypalych;




function PaypalychPay(Request $request)
{

    $user = Auth::user();
    $client = getPaypalychClient();
    $shopProduct = ShopProduct::findOrFail($request->shopProduct);
    $discount = PartnerDiscount::getDiscount();

    if (($shopProduct->currency_code == 'RUB' && $shopProduct->price < 15) || ($shopProduct->currency_code == 'USD' && $shopProduct->price < 1)){
        return Redirect::route('home')->with('error', __('Minimum payment amount for the selected method is 1$ or 15 Rub'))->send();
    }


    // create a new payment
    $payment = Payment::create([
        'user_id' => $user->id,
        'payment_id' => null,
        'payment_method' => 'Paypalych',
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

    $metadata = array(
        "user_id" => $user->id,
        "user_name" => $user->name
    );

    try {
        $response = $client->billCreate(
            array(
                'amount' => $shopProduct->getTotalPrice(),
                'order_id' => $payment->id,
                'description' => 'Пополнение баланса ProtesiaN Host',
                'type' => 'normal',
                'shop_id' => $client->shopId,
                'currency_in' => $shopProduct->currency_code,
                'custom' => json_encode($metadata),
                'payer_pays_commission' => 0,
                'name' => 'ProtesiaN Host',
            )
        );
        Redirect::to(json_decode($response, true)['link_page_url'])->send();
    } catch (\Exception $ex) {
        Log::error('Paypalych Payment: ' . $ex->getMessage());
        $payment->delete();
        Redirect::route('store.index')->with('error', __('Payment failed'))->send();
        return;
    }
}

function PaypalychSuccess()
{
    Redirect::route('home')->with('success', 'Please wait for payment processing')->send();
}
function PaypalychFailed()
{
    Redirect::route('home')->with('error', 'Payment failed')->send();
}
function PaypalychNotification(Request $request)
{
    try {
        $client = getPaypalychClient();

        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);
        $metadata = json_decode($requestBody['custom']);

        $paymentStatus = $requestBody['Status'];
        $payment = Payment::findOrFail($requestBody['InvId']);
        $shopProduct = $payment->shop_item_product_id;

        $user = Auth::user();
        $user = User::findOrFail($metadata['user_id']);

        $signature =strtoupper(md5($requestBody['OutSum'].":".$requestBody['InvId'].":".$client->apiToken));

        if ($signature === $requestBody['SignatureValue']) {
            Log::info('Internal signature: '.$signature. ' corresponds external signature: '.$requestBody['SignatureValue']);
        } else {
            Log::info('Internal signature: '.$signature. ' mismatches external signature: '.$requestBody['SignatureValue']);
        }

        if ($paymentStatus === 'SUCCESS') {
            $payment->update([
            'status' => 'paid',
            'payment_id' => $payment->id,]);

            $user->notify(new ConfirmPaymentNotification($payment));

            event(new UserUpdateCreditsEvent($user));
            event(new PaymentEvent($user, $payment, $shopProduct));

            return response('Successfully', 200);
        } elseif ($paymentStatus === 'FAIL'){
            $payment->update([
                'status' => 'cancelled',
                'payment_id' => $payment->id,
            ]);
            return response('Successfully', 200);
        }
        else {
            return response('Internal Error', 500);
        }
    }catch (\Exception $e) {
        Log::error($e);
    } finally {
        $logInfo = array(
            "NotificationSource" => $payment->payment_method,
            "UserID" => $metadata['user_id'],
            "PaymentID" => $metadata['payment_id'],
            "PaymentAmount" => $payment->total_price,
            "PaymentStatus"=> $paymentStatus
        );

        Log:info(json_encode($logInfo));
    }
}
function getPaypalychClient()
{
    $shopID = config("SETTINGS::PAYMENTS:PAYPALYCH:SHOP_ID");
    $secretKey = config("SETTINGS::PAYMENTS:PAYPALYCH:SECRET_KEY");
    return new Paypalych($shopID, $secretKey);
}
