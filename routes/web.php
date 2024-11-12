<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\productController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [authController::class, 'login'])->name('login');
Route::post('/login', [authController::class, 'loginPost'])->name('login.post');

Route::get('/register', [authController::class, 'registration'])->name('register');
Route::post('/register', [authController::class, 'registrationPost'])->name('registration.post');

Route::get('/logout', [authController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'],function(){

    Route::get('/profile', function () {
        return "Hello";
    });
});

Route::get('/product', [productController::class, 'cards'])->name('products');

Route::get('/admin', [adminController::class, 'admin'])->name('admin');

Route::post('/admin', [adminController::class, 'insertData'])->name('insert.post');
