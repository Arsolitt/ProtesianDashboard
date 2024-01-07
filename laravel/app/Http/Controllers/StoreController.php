<?php

namespace App\Http\Controllers;

use App\Helpers\ExtensionHelper;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /** Display a listing of the resource. */
    public function index()
    {
        $isPaymentSetup = false;

        if (
            env('APP_ENV') == 'local' ||
            config('SETTINGS::PAYMENTS:YOOKASSA:SHOP_ID') && config('SETTINGS::PAYMENTS:YOOKASSA:SECRET_KEY')
        ) {
            $isPaymentSetup = true;
        }

        //Required Verification for creating an server
        if (config('SETTINGS::USER:FORCE_EMAIL_VERIFICATION', false) === 'true' && ! Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('profile.index')->with('error', __('You are required to verify your email address before you can purchase credits.'));
        }

        //Required Verification for creating an server
        if (config('SETTINGS::USER:FORCE_DISCORD_VERIFICATION', false) === 'true' && ! Auth::user()->discordUser) {
            return redirect()->route('profile.index')->with('error', __('You are required to link your discord account before you can purchase Credits'));
        }

        $paymentGateways = [];
        $extensions = ExtensionHelper::getAllExtensionsByNamespace('PaymentGateways');

        // build a paymentgateways array that contains the routes for the payment gateways and the image path for the payment gateway which lays in public/images/Extensions/PaymentGateways with the extensionname in lowercase
        foreach ($extensions as $extension) {
            $extensionName = basename($extension);
            if (!ExtensionHelper::getExtensionConfig($extensionName, 'enabled')) continue; // skip if not enabled

            $payment = new \stdClass();
            $payment->name = ExtensionHelper::getExtensionConfig($extensionName, 'name');
            $payment->image = asset('images/Extensions/PaymentGateways/' . strtolower($extensionName) . '_logo.svg');
            $paymentGateways[] = $payment;
        }

        return view('store.index')->with([
            'isPaymentSetup' => $isPaymentSetup,
            'paymentGateways' => $paymentGateways,
        ]);
    }
}
