<?php

use App\Classes\Settings\Invoices;
use App\Classes\Settings\Language;
use App\Classes\Settings\Misc;
use App\Classes\Settings\Monitoring;
use App\Classes\Settings\Payments;
use App\Classes\Settings\System;
use App\Classes\Settings\Information;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\ApplicationApiController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LegalController;
use App\Http\Controllers\Admin\OverViewController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServerController as AdminServerController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UsefulLinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {

    //overview
    Route::get('legal', [OverViewController::class, 'index'])->name('overview.index');

    Route::get('overview', [OverViewController::class, 'index'])->name('overview.index');
    Route::get('overview/sync', [OverViewController::class, 'syncPterodactyl'])->name('overview.sync');

    Route::resource('activitylogs', ActivityLogController::class);

    //users
    Route::get('users.json', [UserController::class, 'json'])->name('users.json');
    Route::get('users/loginas/{user}', [UserController::class, 'loginAs'])->name('users.loginas');
    Route::get('users/verifyEmail/{user}', [UserController::class, 'verifyEmail'])->name('users.verifyEmail');
    Route::get('users/datatable', [UserController::class, 'datatable'])->name('users.datatable');
    Route::get('users/notifications', [UserController::class, 'notifications'])->name('users.notifications');
    Route::post('users/notifications', [UserController::class, 'notify'])->name('users.notifications');
    Route::post('users/togglesuspend/{user}', [UserController::class, 'toggleSuspended'])->name('users.togglesuspend');
    Route::resource('users', UserController::class);

    //servers
    Route::get('servers/datatable', [AdminServerController::class, 'datatable'])->name('servers.datatable');
    Route::post('servers/togglesuspend/{server}', [AdminServerController::class, 'toggleSuspended'])->name('servers.togglesuspend');
    Route::get('servers/sync', [AdminServerController::class, 'syncServers'])->name('servers.sync');
    Route::resource('servers', AdminServerController::class);

    //products
    Route::get('products/datatable', [ProductController::class, 'datatable'])->name('products.datatable');
    Route::get('products/clone/{product}', [ProductController::class, 'clone'])->name('products.clone');
    Route::patch('products/disable/{product}', [ProductController::class, 'disable'])->name('products.disable');
    Route::resource('products', ProductController::class);

    //store
    // Route::get('store/datatable', [ShopProductController::class, 'datatable'])->name('store.datatable');
    // Route::patch('store/disable/{shopProduct}', [ShopProductController::class, 'disable'])->name('store.disable');
    // Route::resource('store', ShopProductController::class)->parameters([
    //     'store' => 'shopProduct',
    // ]);

    //payments
    Route::get('payments/datatable', [PaymentController::class, 'datatable'])->name('payments.datatable');
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');

    //settings
    Route::get('settings/datatable', [SettingsController::class, 'datatable'])->name('settings.datatable');
    Route::patch('settings/updatevalue', [SettingsController::class, 'updatevalue'])->name('settings.updatevalue');
    Route::get('settings/checkPteroClientkey', [System::class, 'checkPteroClientkey'])->name('settings.checkPteroClientkey');
    Route::redirect('settings#system', 'system')->name('settings.system');

    //settings
    Route::patch('settings/update/invoice-settings', [Invoices::class, 'updateSettings'])->name('settings.update.invoicesettings');
    Route::patch('settings/update/language', [Language::class, 'updateSettings'])->name('settings.update.languagesettings');
    Route::patch('settings/update/monitoring', [Monitoring::class, 'updateSettings'])->name('settings.update.monitoringsettings');
    Route::patch('settings/update/payment', [Payments::class, 'updateSettings'])->name('settings.update.paymentsettings');
    Route::patch('settings/update/misc', [Misc::class, 'updateSettings'])->name('settings.update.miscsettings');
    Route::patch('settings/update/system', [System::class, 'updateSettings'])->name('settings.update.systemsettings');
    Route::patch('settings/update/information', [Information::class, 'updateSettings'])->name('settings.update.informationsettings');
    Route::resource('settings', SettingsController::class)->only('index');

    //invoices
    Route::get('invoices/download-invoices', [InvoiceController::class, 'downloadAllInvoices'])->name('invoices.downloadAllInvoices');
    Route::get('invoices/download-single-invoice', [InvoiceController::class, 'downloadSingleInvoice'])->name('invoices.downloadSingleInvoice');

    //usefullinks
    Route::get('usefullinks/datatable', [UsefulLinkController::class, 'datatable'])->name('usefullinks.datatable');
    Route::resource('usefullinks', UsefulLinkController::class);

    //legal
    Route::get('legal', [LegalController::class, 'index'])->name('legal.index');
    Route::patch('legal', [LegalController::class, 'update'])->name('legal.update');

    //vouchers
    Route::get('vouchers/datatable', [VoucherController::class, 'datatable'])->name('vouchers.datatable');
    Route::get('vouchers/{voucher}/usersdatatable', [VoucherController::class, 'usersdatatable'])->name('vouchers.usersdatatable');
    Route::get('vouchers/{voucher}/users', [VoucherController::class, 'users'])->name('vouchers.users');
    Route::resource('vouchers', VoucherController::class);

    //partners
    Route::get('partners/datatable', [PartnerController::class, 'datatable'])->name('partners.datatable');
    Route::get('partners/{voucher}/users', [PartnerController::class, 'users'])->name('partners.users');
    Route::resource('partners', PartnerController::class);

    //api-keys
    Route::get('api/datatable', [ApplicationApiController::class, 'datatable'])->name('api.datatable');
    Route::resource('api', ApplicationApiController::class)->parameters([
        'api' => 'applicationApi',
    ]);
});
