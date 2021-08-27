<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
})->name('home');


Route::get('products/{product}/purchase', [ProductController::class, 'purchaseView'])->name('products.purchaseView');
Route::get('products/{product}/sale', [ProductController::class, 'saleView'])->name('products.saleView');
Route::post('products/{product}/purchase', [ProductController::class, 'purchase'])->name('products.purchase');
Route::post('products/{product}/sale', [ProductController::class, 'sale'])->name('products.sale');

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
