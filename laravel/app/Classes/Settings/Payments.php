<?php

namespace App\Classes\Settings;

use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class Payments
{
    public function __construct()
    {

    }

    public function updateSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stripe-secret-key' => 'nullable|string',
            'stripe-endpoint-secret' => 'nullable|string',
            'stripe-test-secret-key' => 'nullable|string',
            'stripe-test-endpoint-secret' => 'nullable|string',
            'stripe-methods' => 'nullable|string',
            'yookassa-shop-id' => 'nullable|string',
            'yookassa-secret-key' => 'nullable|string',
            'paypalych-shop-id' => 'nullable|string',
            'paypalych-secret-key' => 'nullable|string',
            'paypalych-enabled' => 'nullable|boolean',
            'minimum-amount' => 'numeric|min:1|max:999999',
            'maximum-amount' => 'numeric|min:1|max:999999',
            'sales-tax' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.settings.index').'#payment')->with('error', __('Payment settings have not been updated!'))->withErrors($validator)
                ->withInput();
        }

        $values = [
            //SETTINGS::VALUE => REQUEST-VALUE (coming from the html-form)
            'SETTINGS::PAYMENTS:STRIPE:SECRET' => 'stripe-secret',
            'SETTINGS::PAYMENTS:STRIPE:ENDPOINT_SECRET' => 'stripe-endpoint-secret',
            'SETTINGS::PAYMENTS:STRIPE:TEST_SECRET' => 'stripe-test-secret',
            'SETTINGS::PAYMENTS:STRIPE:ENDPOINT_TEST_SECRET' => 'stripe-endpoint-test-secret',
            'SETTINGS::PAYMENTS:STRIPE:METHODS' => 'stripe-methods',
            'SETTINGS::PAYMENTS:YOOKASSA:SHOP_ID' => 'yookassa-shop-id',
            'SETTINGS::PAYMENTS:YOOKASSA:SECRET_KEY' => 'yookassa-secret-key',
            'SETTINGS::PAYMENTS:PAYPALYCH:SHOP_ID' => 'paypalych-shop-id',
            'SETTINGS::PAYMENTS:PAYPALYCH:SECRET_KEY' => 'paypalych-secret-key',
            'SETTINGS::PAYMENTS:MINIMUM_AMOUNT' => 'minimum-amount',
            'SETTINGS::PAYMENTS:MAXIMUM_AMOUNT' => 'maximum-amount',
            'SETTINGS::PAYMENTS:SALES_TAX' => 'sales-tax',
        ];

        foreach ($values as $key => $value) {
            $param = $request->get($value);

            Settings::where('key', $key)->updateOrCreate(['key' => $key], ['value' => $param]);
            Cache::forget('setting'.':'.$key);
        }

        return redirect(route('admin.settings.index').'#payment')->with('success', __('Payment settings updated!'));
    }
}
