<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

// ─── Public Marketing Pages ───────────────────────────────────────────────────
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/how-it-works', [PublicController::class, 'howItWorks'])->name('how-it-works');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::get('/calculator', [PublicController::class, 'calculator'])->name('calculator');
Route::get('/catalog', [PublicController::class, 'catalog'])->name('catalog');
Route::get('/track-shipment', [PublicController::class, 'trackShipment'])->name('track-shipment');
Route::get('/checkout', [PublicController::class, 'checkout'])->name('checkout');

// Warehouse Pages
Route::get('/warehouses', [PublicController::class, 'warehousesIndex'])->name('warehouses.index');
Route::get('/warehouses/usa', [PublicController::class, 'warehouseShow'])->defaults('slug', 'usa')->name('warehouses.usa');
Route::get('/warehouses/uk', [PublicController::class, 'warehouseShow'])->defaults('slug', 'uk')->name('warehouses.uk');
Route::get('/warehouses/malaysia', [PublicController::class, 'warehouseShow'])->defaults('slug', 'malaysia')->name('warehouses.malaysia');

// Product Pages
Route::get('/products/{slug}', [PublicController::class, 'productShow'])->name('products.show');


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
