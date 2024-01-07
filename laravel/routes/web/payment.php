<?php

use App\Http\Controllers\Admin\PaymentController;
use Illuminate\Support\Facades\Route;


Route::post('store/checkout', [PaymentController::class, 'checkOut'])->name('store.checkout');
Route::get('payment/pay/{payment_internal_id}', [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('payment/FreePay/{shopProduct}', [PaymentController::class, 'FreePay'])->name('payment.FreePay');
Route::get('payment/Cancel', [PaymentController::class, 'Cancel'])->name('payment.Cancel');
