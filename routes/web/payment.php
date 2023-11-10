<?php

use App\Http\Controllers\Admin\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('checkout/{shopProduct}', [PaymentController::class, 'checkOut'])->name('checkout');
Route::post('payment/pay', [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('payment/FreePay/{shopProduct}', [PaymentController::class, 'FreePay'])->name('payment.FreePay');
Route::get('payment/Cancel', [PaymentController::class, 'Cancel'])->name('payment.Cancel');
