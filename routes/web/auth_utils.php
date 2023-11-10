<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('users/logbackin', [UserController::class, 'logBackIn'])->name('users.logbackin');

//discord
Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/callback', [SocialiteController::class, 'callback'])->name('auth.callback');

//voucher redeem
Route::post('/voucher/redeem', [VoucherController::class, 'redeem'])->middleware('throttle:5,1')->name('voucher.redeem');

//resend verification email
Route::get('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:3,1'])->name('verification.send');
