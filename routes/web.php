<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\productController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\forgetPasswordManager;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [authController::class, 'login'])->name('login');
Route::post('/login', [authController::class, 'loginPost'])->name('login.post');

Route::get('/register', [authController::class, 'registration'])->name('register');
Route::post('/register', [authController::class, 'registrationPost'])->name('registration.post');

Route::get('/logout', [authController::class, 'logout'])->name('logout');
Route::get('/user_profile', [authController::class, 'profile'])->name('profile');

Route::post('/user_profile/update', [authController::class, 'updateProfile'])->name('profile.update');

Route::group(['middleware' => 'auth'],function(){

    Route::get('/profile', function () {
        return "Hello";
    });
});

Route::get('/product', [productController::class, 'cards'])->name('products');

Route::get('/admin', [adminController::class, 'admin'])->name('admin');

Route::post('/admin', [adminController::class, 'insertData'])->name('insert.post');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{item}', [CartController::class, 'addToCart'])->name('cart.add');
    // Add additional routes for updating and removing items if needed.
});


// cart view
Route::middleware('auth')->get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

// quntity update
Route::patch('/cart/update/{item}', [CartController::class, 'updateCart'])->name('cart.update');

// remove items in cart
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');


// Checkout section
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout/customer-details', [CheckoutController::class, 'showCustomerDetails'])->name('checkout.customerDetails');
    Route::post('/checkout/customer-details', [CheckoutController::class, 'saveCustomerDetails']);
    
    Route::get('/checkout/payment-method', [CheckoutController::class, 'showPaymentMethod'])->name('checkout.paymentMethod');
    Route::post('/checkout/payment-method', [CheckoutController::class, 'savePaymentMethod']);
    
    Route::post('/checkout/confirmation', [CheckoutController::class, 'showConfirmation'])->name('checkout.confirmation');
    
});
Route::post('/order/complete', [CheckoutController::class, 'completeOrder'])->name('order.complete');
Route::get('/order/thank-you', function () {
    return view('checkout.thank-you');
})->name('order.thankYou');


Route::get("/forget-password", [forgetPasswordManager::class, "forgetpassword"])->name("forget-Password");
Route::post("/forget-password", [forgetPasswordManager::class, "forgetpasswordPost"])->name("forget-Password-post");

Route:: get("/reset-password/{token}", [forgetPasswordManager::class, "resetPasswords"])->name("reset.password");