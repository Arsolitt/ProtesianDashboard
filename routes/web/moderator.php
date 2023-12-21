<?php

use App\Http\Controllers\Moderation\TicketCategoryController;
use App\Http\Controllers\Moderation\TicketsController as ModTicketsController;
use Illuminate\Support\Facades\Route;

Route::prefix('moderator')->name('moderator.')->middleware('moderator')->group(function () {
    //ticket moderation
    Route::get('ticket', [ModTicketsController::class, 'index'])->name('ticket.index');
    Route::get('ticket/datatable', [ModTicketsController::class, 'datatable'])->name('ticket.datatable');
    Route::get('ticket/show/{ticket_id}', [ModTicketsController::class, 'show'])->name('ticket.show');
    Route::post('ticket/reply', [ModTicketsController::class, 'reply'])->name('ticket.reply');
    Route::post('ticket/status/{ticket_id}', [ModTicketsController::class, 'changeStatus'])->name('ticket.changeStatus');
    Route::post('ticket/delete/{ticket_id}', [ModTicketsController::class, 'delete'])->name('ticket.delete');
    //ticket moderation blacklist
    Route::get('ticket/blacklist', [ModTicketsController::class, 'blacklist'])->name('ticket.blacklist');
    Route::post('ticket/blacklist', [ModTicketsController::class, 'blacklistAdd'])->name('ticket.blacklist.add');
    Route::post('ticket/blacklist/delete/{id}', [ModTicketsController::class, 'blacklistDelete'])->name('ticket.blacklist.delete');
    Route::post('ticket/blacklist/change/{id}', [ModTicketsController::class, 'blacklistChange'])->name('ticket.blacklist.change');
    Route::get('ticket/blacklist/datatable', [ModTicketsController::class, 'dataTableBlacklist'])->name('ticket.blacklist.datatable');


    Route::get('ticket/category/datatable', [TicketCategoryController::class, 'datatable'])->name('ticket.category.datatable');
    Route::resource("ticket/category", TicketCategoryController::class,['as' => 'ticket']);

});
