<?php

use Illuminate\Support\Facades\Route;

include_once(__DIR__ . '/index.php');
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('payment/YookassaPay/{payment_internal_id}', function () {
        YookassaPay(request());
    })->name('payment.YookassaPay');

    Route::get(
        'payment/YookassaSuccess/{payment_internal_id}',
        function () {
            YookassaSuccess();
        }
    )->name('payment.YookassaSuccess');

    Route::get(
        'payment/YookassaFailed/{payment_internal_id}',
        function () {
            YookassaFailed(request());
        }
    )->name('payment.YookassaFailed');
});

Route::post('payment/YookassaNotification', function () {
    YookassaNotification(request());
})->name('payment.YookassaNotification');
