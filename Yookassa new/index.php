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
use YooKassa\Model\Notification\NotificationEventType;


function YookassaPay(Request $request)
{
    $payment = Payment::findOrFail($request->payment_internal_id);
    if ($payment->status === 'paid' || $payment->status === 'pending') {
        Redirect::route('home')->with('success', 'Платёж уже в обработке!')->send();
    }
    $user = User::findOrFail($payment->user_id);
    $client = getYookassaClient();

    try {
        $response = $client->createPayment(
            array(
                'amount' => array(
                    'value' => $payment->total_price,
                    'currency' => $payment->currency_code,
                ),
                'confirmation' => array(
                    'type' => 'redirect',
                    'return_url' => route('payment.YookassaSuccess', $payment->id),
                ),
                'capture' => true,
                'description' => 'Пополнение баланса Veroid',
                "metadata" => array(
                    'user_id' => $payment->user_id,
                    'internal_payment_id' => $payment->id,
                ),
                "receipt" => array(
                    "customer" => array(
                        "full_name" => $user->name,
                        "email" => $user->email,
                    ),
                    "items" => array(
                        array(
                            "description" => "Пополнение баланса Veroid",
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
            uniqid('veroid_', true)
        );
        $payment->update([
            'payment_id' => $response->getId(),
            'status' => 'pending',
        ]);
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
    if (!in_array($request->header('CF-Connecting-IP'), $IPWhitelist)) {
        Log::error('IP ' . $request->header('CF-Connecting-IP') . ' not in whitelist');
        return response('IP is not in whitelist', 403);
    }
    try {
        $data = json_decode($request->getContent(), true);
        $notification = ($data['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($data)
            : new NotificationCanceled($data);

        $client = getYookassaClient();
        $YooPayment = $client->getPaymentInfo($notification->getObject()->id);
        $metadata = $YooPayment->getMetadata()->toArray();

        $user = User::findOrFail($metadata['user_id']);
        $payment = Payment::findOrFail($metadata['internal_payment_id']);

        $logInfo = array(
            "NotificationSource" => "Payment Gateway",
            "UserID" => $payment->user_id,
            "PaymentMethod" => $payment->payment_method,
            "PaymentID" => $payment->id,
            "PaymentAmount" => $payment->total_price,
            "PaymentStatus" => $YooPayment->status === 'succeeded' ? 'paid' : 'cancelled',
        );
        Log::info(json_encode($logInfo));

        if ($YooPayment->status === 'succeeded') {
            //update payment
            $payment->update([
                'status' => 'paid',
            ]);

            $user->notify(new ConfirmPaymentNotification($payment));
            event(new UserUpdateCreditsEvent($user));
            event(new PaymentEvent($user, $payment));

        } else {
            $payment->update([
                'status' => 'cancelled',
            ]);
        }
        return response('Successfully', 200);
    } catch (\Exception $e) {
        Log::error($e);
    }
}

function YookassaSuccess()
{
    Redirect::route('home')->with('success', 'Платёж обрабатывается')->send();
}

function YookassaFailed(Request $request)
{
    $payment = Payment::find($request->payment_internal_id);
    if ($payment->status === 'open' || $payment->status === 'pending') {
        $payment->update([
            'status' => 'cancelled'
        ]);
    }
    Redirect::route('home')->with('error', 'Платёж не удался')->send();
}

function getYookassaClient()
{
    $client = new Client();
    $shopID = '263883';
    $secretKey = 'test_BioCumMlA9y79ehaxxab1XN-HimHHokKtA-GZbeSGr4';
    $client->setAuth($shopID, $secretKey);
    return $client;
}
