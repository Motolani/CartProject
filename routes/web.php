<?php

use App\Http\Controllers\CouponsController;
use App\Http\Controllers\ProductsController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

//all products
Route::get('/products', [ProductsController::class, 'index'])->name('Products');
//addProductToCart
Route::get('/addtocart/{id}', [ProductsController::class, 'addProductToCart'])->name('addToCart');

//showCart
Route::get('/cart', [ProductsController::class, 'showCartProducts'])->name('cartProducts');
//deleteCart
Route::get('/deletecartitem/{id}', [ProductsController::class, 'deleteCartItem'])->name('deleteCartItem');

//Coupon
Route::post('/coupon', [CouponsController::class, 'store'])->name('coupon.store');
Route::delete('/coupon', [CouponsController::class, 'destroy'])->name('coupon.destroy');
