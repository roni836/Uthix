<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/add-to-cart', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::delete('/cart/clear', [CartController::class, 'clearCart']);
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart']);

    Route::put('/cart/update/{cartId}', [CartController::class, 'updateCart']);

    Route::apiResource('wishlist', WishlistController::class);
    Route::apiResource('address', AddressController::class);
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('books', BookController::class);
Route::get('/categories/{id}/books',[BookController::class,'getBookByCategories']);
Route::get('/books/filter', [BookController::class, 'filterBooks']);
Route::apiResource('coupons', CouponController::class);

