<?php

use Illuminate\Support\Facades\Route;

include_once(__DIR__ . '/index.php');
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('payment/PaypalychPay/{shopProduct}', function () {
        PaypalychPay(request());
    })->name('payment.PaypalychPay');

    Route::get(
        'payment/PaypalychSuccess',
        function () {
            PaypalychSuccess();
        }
    )->name('payment.PaypalychSuccess');

    Route::get(
        'payment/PaypalychFailed',
        function () {
            PaypalychFailed();
        }
    )->name('payment.PaypalychSuccess');
});

Route::post('payment/PaypalychNotification', function () {
    PaypalychNotification(request());
})->name('payment.PaypalychNotification');
