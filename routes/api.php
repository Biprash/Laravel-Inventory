<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group(['middleware' => 'auth:sanctum'], function () {
//    Route::apiResource('products', ProductController::class);
//});

Route::apiResource('products', ProductController::class);
Route::post('products/{product}/purchase', [ProductController::class, 'purchase']);
Route::post('products/{product}/sale', [ProductController::class, 'sale']);

Route::apiResource('orders', \App\Http\Controllers\OrderController::class)->only(['index', 'store']);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('categories', CategoryController::class);
