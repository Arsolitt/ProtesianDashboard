<?php

use App\Http\Controllers\TranslationController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('download/{filename}', function($filename)
{
    // Check if file exists in app/storage/files folder
    $file_path = storage_path() .'/files/'. $filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        // Error
        exit('Запрошенный файл не существует!');
    }
})
    ->where('filename', '[A-Za-z0-9\-\_\.]+')->name('download');

Route::get('/svoystalcraft', function () {
    return view('svoystalcraft');
})->name('svoystalcraft');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('changelocale', [TranslationController::class, 'changeLocale'])->name('changeLocale');
