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
        "enabled" => true,
    ];
}
