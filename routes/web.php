<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// SSLCommerz Webhooks & Callbacks
Route::post('/payment/success', [\App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/fail', [\App\Http\Controllers\PaymentController::class, 'fail'])->name('payment.fail');
Route::post('/payment/cancel', [\App\Http\Controllers\PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/payment/ipn', [\App\Http\Controllers\PaymentController::class, 'ipn'])->name('payment.ipn');

// Public Tracking System
Route::get('/track', [TrackingController::class, 'index'])->name('tracking.index')->middleware('throttle:30,1');
Route::get('/track/search', [TrackingController::class, 'search'])->name('tracking.search')->middleware('throttle:10,1');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/payment/initiate/{invoice}', [\App\Http\Controllers\PaymentController::class, 'initiate'])->name('payment.initiate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Orders Flow (Shop For Me)
    Route::resource('orders', \App\Http\Controllers\OrderController::class)
        ->only(['index', 'create', 'store', 'show']);
    Route::post('/orders/{order}/approve', [\App\Http\Controllers\OrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{order}/reject', [\App\Http\Controllers\OrderController::class, 'reject'])->name('orders.reject');

    // User Resource Views
    Route::resource('parcels', \App\Http\Controllers\ParcelController::class)->only(['index', 'show']);
    Route::resource('shipments', \App\Http\Controllers\ShipmentController::class)->only(['index', 'show']);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class)->only(['index', 'show']);

    // Support Tickets (Customer Frontend)
    Route::resource('tickets', \App\Http\Controllers\TicketController::class)->only(['index', 'create', 'store', 'show']);
    Route::post('tickets/{ticket}/reply', [\App\Http\Controllers\TicketController::class, 'reply'])->name('tickets.reply');
});

require __DIR__.'/auth.php';
