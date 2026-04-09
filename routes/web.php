<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TrackingController;
use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/how-it-works', [PublicController::class, 'howItWorks'])->name('how-it-works');
Route::get('/faq', [PublicController::class, 'faq'])->name('faq');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('contact.submit');
Route::get('/calculator', [PublicController::class, 'calculator'])->name('calculator');
Route::post('/api/calculator', [PublicController::class, 'calculate'])->name('api.calculator');
Route::get('/shop', [PublicController::class, 'catalog'])->name('shop');
Route::get('/track-shipment', [PublicController::class, 'trackShipment'])->name('track-shipment');
Route::get('/checkout', [PublicController::class, 'checkout'])->name('checkout');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/cart/empty', [PublicController::class, 'cartEmpty'])->name('cart.empty');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Warehouse Pages
Route::get('/warehouses', [PublicController::class, 'warehousesIndex'])->name('warehouses.index');
Route::get('/warehouses/usa', [PublicController::class, 'warehouseShow'])->defaults('slug', 'usa')->name('warehouses.usa');
Route::get('/warehouses/uk', [PublicController::class, 'warehouseShow'])->defaults('slug', 'uk')->name('warehouses.uk');
Route::get('/warehouses/malaysia', [PublicController::class, 'warehouseShow'])->defaults('slug', 'malaysia')->name('warehouses.malaysia');

// Product Pages
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// SSLCommerz Webhooks & Callbacks
Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::post('/payment/fail', [PaymentController::class, 'fail'])->name('payment.fail');
Route::post('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/payment/ipn', [PaymentController::class, 'ipn'])->name('payment.ipn');

// Public Tracking System
Route::get('/track', [TrackingController::class, 'index'])->name('tracking.index')->middleware('throttle:30,1');
Route::get('/track/search', [TrackingController::class, 'search'])->name('tracking.search')->middleware('throttle:10,1');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/payment/initiate/{invoice}', [PaymentController::class, 'initiate'])->name('payment.initiate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Orders Flow (Shop For Me)
    Route::resource('orders', OrderController::class)
        ->only(['index', 'create', 'store', 'show']);
    Route::post('/orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');

    // User Resource Views
    Route::resource('parcels', ParcelController::class)->only(['index', 'show']);
    Route::resource('shipments', ShipmentController::class)->only(['index', 'show']);
    Route::resource('invoices', InvoiceController::class)->only(['index', 'show']);

    // Support Tickets (Customer Frontend)
    Route::resource('tickets', TicketController::class)->only(['index', 'create', 'store', 'show']);
    Route::post('tickets/{ticket}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
});

// ─── Custom Admin Panel ───────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest-only admin routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminController::class, 'login']);
    });

    // Protected admin routes
    Route::middleware(AdminAuthMiddleware::class)->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/reports', [AdminReportController::class, 'index'])->name('reports');
        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
        Route::put('/settings/warehouses/{warehouse}', [AdminSettingsController::class, 'updateWarehouse'])->name('settings.warehouses.update');
        Route::post('/settings/warehouses', [AdminSettingsController::class, 'storeWarehouse'])->name('settings.warehouses.store');
        Route::delete('/settings/warehouses/{warehouse}', [AdminSettingsController::class, 'destroyWarehouse'])->name('settings.warehouses.destroy');
        Route::put('/settings/shipping-modes/{shippingMode}', [AdminSettingsController::class, 'updateShippingMode'])->name('settings.shipping-modes.update');
        Route::post('/settings/shipping-modes', [AdminSettingsController::class, 'storeShippingMode'])->name('settings.shipping-modes.store');
        Route::delete('/settings/shipping-modes/{shippingMode}', [AdminSettingsController::class, 'destroyShippingMode'])->name('settings.shipping-modes.destroy');
        Route::post('/settings/rates', [AdminSettingsController::class, 'updateRates'])->name('settings.rates.update');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});

require __DIR__.'/auth.php';
