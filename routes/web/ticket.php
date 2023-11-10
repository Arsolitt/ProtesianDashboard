<?php

use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;

if (config('SETTINGS::TICKET:ENABLED')) {
    Route::get('ticket', [TicketsController::class, 'index'])->name('ticket.index');
    Route::get('ticket/datatable', [TicketsController::class, 'datatable'])->name('ticket.datatable');
    Route::get('ticket/new', [TicketsController::class, 'create'])->name('ticket.new');
    Route::post('ticket/new', [TicketsController::class, 'store'])->middleware(['throttle:ticket-new'])->name('ticket.new.store');
    Route::get('ticket/show/{ticket_id}', [TicketsController::class, 'show'])->name('ticket.show');
    Route::post('ticket/reply', [TicketsController::class, 'reply'])->middleware(['auth'])->name('ticket.reply');
    Route::post('ticket/status/{ticket_id}', [TicketsController::class, 'changeStatus'])->name('ticket.changeStatus');
}
