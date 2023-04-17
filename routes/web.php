<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerGiftCardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\GiftCardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});



Route::get('register', [RegisterController::class, 'create'])->name('register.create');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');

Route::get('login', [LoginController::class, 'create'])->name('login.create');
Route::post('login', [LoginController::class, 'store'])->name('login.store');

Route::get('/logout', [LoginController::class, 'destroy']);

Route::middleware('user')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('home.index');
    Route::resource('user', UserController::class);
    Route::resource('expense', ExpenseController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('customer-gift-card', CustomerGiftCardController::class);
    Route::resource('product', ProductController::class);
    Route::resource('pos', PosController::class);
    Route::get('booking/calendar', [BookingController::class, 'calendar'])->name('booking.calendar');
    Route::resource('booking', BookingController::class);
    Route::resource('stock', StockController::class);
    Route::resource('gift-card', GiftCardController::class);
    Route::get('gift-card/code/GC', [GiftCardController::class, 'generateCode'])->name('gift-card.code');
    Route::resource('order', OrderController::class);


    //order
   
    // Route::get('/today-order', [OrderController::class, 'todayOrder']);
    // Route::get('/orders/{id}', [OrderController::class, 'orders']);
    // Route::get('/order/details/{id}', [OrderController::class, 'orderDetails']);


    //gift card
    Route::get('customer-gift-card-list', [GiftCardController::class, 'getGiftCardList'])->name('customer-gift-card-list');

    //Customer Gift Card Routes
    Route::post('/add-customer-gift-card/{id}', [CustomerGiftCardController::class, 'addGiftCardId'])->name('add-customer-gift-card');
    

    //Cart Routes
    Route::get('/gift-card-list', [GiftCardController::class,'getGiftCardList']);
    Route::post('/cart/orders', [CartController::class, 'order'])->name('cart.orders');
    Route::resource('cart', CartController::class);
    Route::get('/cart/delete/{id}', [CartController::class,'cartDelete']);
    Route::get('/cart-products', [CartController::class,'cartProducts']);
    Route::get('cart/addToCart/{id}', [CartController::class, 'addToCart'])->name('cart.addToCart');

});

Route::post('check-mail-register', [RegisterController::class, 'checkMailRegister'])->name('register.checkMail');
Route::post('/product/checkCode', [ProductController::class, 'checkProductCode'])->name('product.checkCode');
Route::post('check-user-login', [LoginController::class, 'checkUserLogin'])->name('login.checkUserLogin');
