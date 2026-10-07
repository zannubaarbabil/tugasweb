<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\OrderController;

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/books', [BookController::class, 'index'])
    ->name('books.index');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

Route::get('/books/{id}', [BookController::class, 'show'])
    ->name('book.show');

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/categories/{id}', [CategoryController::class, 'show'])
    ->name('categories.show');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::resource('books', AdminBookController::class);
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('authors', AuthorController::class);
        Route::resource('publishers', PublisherController::class);
        Route::resource('sliders', SliderController::class);
        Route::resource('orders', OrderController::class);
    });

Route::middleware('auth')->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])
        ->name('cart.add');

    Route::post('/cart/update/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');

    Route::post('/checkout', [CheckoutController::class, 'checkout'])
        ->name('checkout');

    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])
        ->name('checkout.success');

});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::get('/dashboard', [CustomerController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::get('/dashboard/orders', [CustomerController::class, 'orders'])
    ->middleware(['auth'])
    ->name('customer.orders');

Route::get('/dashboard/orders/{id}', [CustomerController::class, 'showOrder'])
    ->middleware(['auth'])
    ->name('customer.orders.show');

Route::get('/dashboard/orders/{id}/receipt', [CustomerController::class, 'receipt'])
    ->middleware(['auth'])
    ->name('customer.orders.receipt');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
