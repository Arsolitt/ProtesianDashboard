<?php

namespace App\Extensions\PaymentGateways\Paypalych;

function getConfig()
{
    return [
        "name" => "Paypalych",
        "description" => "Paypalych payment gateway",
        "RoutesIgnoreCsrf" => [
            "payment/PaypalychNotification",
        ],
        "enabled" => config('SETTINGS::PAYMENTS:PAYPALYCH:SHOP_ID') && config('SETTINGS::PAYMENTS:PAYPALYCH:SECRET_KEY'),
    ];
}
