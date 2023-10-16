<?php

use Illuminate\Support\Facades\Route;

include_once(__DIR__ . '/index.php');
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('payment/YookassaPay/{shopProduct}', function () {
        YookassaPay(request());
    })->name('payment.YookassaPay');
});

Route::post('payment/YookassaNotification', function () {
    YookassaNotification(request());
//    return response('TEST YOOKASSA NOTIFICATION SYSTEM', 200);
})->name('payment.YookassaNotification');
