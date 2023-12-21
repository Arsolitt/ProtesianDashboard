<?php

use Illuminate\Support\Facades\Route;

Route::get('/privacy', function () {
    return view('information.privacy');
})->name('privacy');
Route::get('/imprint', function () {
    return view('information.imprint');
})->name('imprint');
Route::get('/tos', function () {
    return view('information.tos');
})->name('tos');
