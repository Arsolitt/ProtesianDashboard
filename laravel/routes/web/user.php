<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('notifications/readAll', [NotificationController::class, 'readAll'])->name('notifications.readAll');
Route::resource('notifications', NotificationController::class);
Route::resource('servers', ServerController::class);
if (config('SETTINGS::SYSTEM:ENABLE_UPGRADE')) {
    Route::post('servers/{server}/upgrade', [ServerController::class, 'upgrade'])->name('servers.upgrade');
}

Route::post('profile/selfdestruct', [ProfileController::class, 'selfDestroyUser'])->name('profile.selfDestroyUser');
Route::resource('profile', ProfileController::class);
Route::resource('store', StoreController::class);
