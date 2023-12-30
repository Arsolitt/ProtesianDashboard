<?php

namespace App\Extensions\PaymentGateways\Yookassa;

function getConfig()
{
    return [
        "name" => "Yookassa",
        "description" => "Yookassa payment gateway",
        "RoutesIgnoreCsrf" => [
            "payment/YookassaNotification",
        ],
        "enabled" => config('SETTINGS::PAYMENTS:YOOKASSA:SHOP_ID') && config('SETTINGS::PAYMENTS:YOOKASSA:SECRET_KEY'),
    ];
}
