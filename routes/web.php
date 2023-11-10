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
use App\Http\Controllers\Admin\ShopProductController;
use App\Http\Controllers\Admin\UsefulLinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Moderation\TicketCategoryController;
use App\Http\Controllers\Moderation\TicketsController as ModTicketsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController as FrontProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

require 'web/privacy.php';
require 'web/utils.php';

Route::middleware(['auth', 'checkSuspended'])->group(function () {

    require 'web/user.php';
    require 'web/product.php';
    require 'web/payment.php';
    require 'web/auth_utils.php';
    require 'web/ticket.php';
    require 'web/admin.php';
    require 'web/moderator.php';

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

require __DIR__ . '/extensions_web.php';
