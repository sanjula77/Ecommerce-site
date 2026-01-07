<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\productController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ForgetPasswordManager;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [authController::class, 'login'])->name('login');
Route::post('/login', [authController::class, 'loginPost'])->name('login.post');

Route::get('/register', [authController::class, 'registration'])->name('register');
Route::post('/register', [authController::class, 'registrationPost'])->name('registration.post');

Route::get('/logout', [authController::class, 'logout'])->name('logout');
Route::middleware('auth')->get('/user_profile', [authController::class, 'profile'])->name('profile');

Route::middleware('auth')->post('/user_profile/update', [authController::class, 'updateProfile'])->name('profile.update');

Route::group(['middleware' => 'auth'],function(){

    Route::get('/profile', function () {
        return "Hello";
    });
});

Route::get('/product', [productController::class, 'cards'])->name('products');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [adminController::class, 'admin'])->name('admin');
    Route::post('/admin', [adminController::class, 'insertData'])->name('insert.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{item}', [CartController::class, 'addToCart'])->name('cart.add');
    // Add additional routes for updating and removing items if needed.
});


// cart view
Route::middleware('auth')->get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

// quantity update
Route::middleware('auth')->patch('/cart/update/{item}', [CartController::class, 'updateCart'])->name('cart.update');

// remove items in cart
Route::middleware('auth')->delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


// Checkout section
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/customer-details', [CheckoutController::class, 'showCustomerDetails'])->name('checkout.customerDetails');
    Route::post('/checkout/customer-details', [CheckoutController::class, 'saveCustomerDetails']);
    
    Route::get('/checkout/payment-method', [CheckoutController::class, 'showPaymentMethod'])->name('checkout.paymentMethod');
    Route::post('/checkout/payment-method', [CheckoutController::class, 'savePaymentMethod']);
    
    Route::get('/checkout/confirmation', [CheckoutController::class, 'showConfirmation'])->name('checkout.confirmation');
    
});
Route::middleware('auth')->post('/order/complete', [CheckoutController::class, 'completeOrder'])->name('order.complete');
Route::middleware('auth')->get('/order/thank-you/{order?}', function ($orderId = null) {
    $order = $orderId ? \App\Models\Order::with('orderItems.item')->findOrFail($orderId) : null;
    return view('checkout.thank-you', compact('order'));
})->name('order.thankYou');


// Reset password
Route::get("/forget-password", [ForgetPasswordManager::class, "forgetPassword"])->name("forget.password");
Route::post("/forget-password", [ForgetPasswordManager::class, "forgetPasswordPost"])->name("forget.password.post");
Route::get('/reset-password/{token}', [ForgetPasswordManager::class, 'resetPassword'])->name('reset.password');
Route::post("/reset-password", [ForgetPasswordManager::class, "resetPasswordPost"])->name("reset.password.post");

