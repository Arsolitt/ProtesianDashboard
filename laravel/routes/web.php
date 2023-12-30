<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
