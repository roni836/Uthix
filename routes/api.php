<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;

use App\Http\Controllers\WishlistController;
use App\Http\Middleware\RoleMiddleware;
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
    Route::apiResource('orders', OrderController::class);
    Route::delete('/orders/{id}/cancel', [OrderController::class, 'cancelOrder']); 
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);

    Route::post('/create-payment', [PaymentController::class, 'createPayment']);
    Route::post('/verify-payment', [PaymentController::class, 'callback']);
});

// Route::middleware(['auth:sanctum'])->group(function () {

//     // Admin routes
//     Route::middleware([RoleMiddleware::class . ':admin'])->get('/admin-dashboard',function(){
//         return response()->json(['message' => 'admin API is working!']);
//     });
//     Route::middleware([RoleMiddleware::class . ':instructor'])->get('/instructor-dashboard',function(){
//         return response()->json(['message' => 'instructor API is working!']);
//     });
//     Route::middleware([RoleMiddleware::class . ':seller'])->get('/seller-dashboard',function(){
//         return response()->json(['message' => 'seller API is working!']);
//     });
//     Route::middleware([RoleMiddleware::class . ':student'])->get('/student-dashboard',function(){
//         return response()->json(['message' => 'student API is working!']);
//     });
// });

Route::middleware(['auth:sanctum'])->group(function () {

    // Admin routes
    Route::middleware([RoleMiddleware::class . ':admin'])->get('/admin-dashboard',function(){
        return response()->json(['message' => 'admin API is working!']);});

        Route::middleware([RoleMiddleware::class . ':seller'])->get('/seller-dashboard',function(){
                    return response()->json(['message' => 'seller API is working!']);
                });
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});



Route::apiResource('vendors', VendorController::class);
Route::get('/categories/{id}/products',[ProductController::class,'getproductByCategories']);
Route::get('/products/filter', [ProductController::class, 'filterProducts']);
Route::apiResource('coupons', CouponController::class);


 

