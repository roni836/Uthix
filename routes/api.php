<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhonePeController;
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
    Route::post('/phonepe/initiate', [PhonePeController::class, 'initiatePayment']);


});

Route::middleware(['auth:sanctum'])->group(function () {

    // Admin routes
    Route::middleware([RoleMiddleware::class . ':admin'])->get('/admin-dashboard',function(){
        return response()->json(['message' => 'admin API is working!']);
    });
    Route::middleware([RoleMiddleware::class . ':instructor'])->get('/instructor-dashboard',function(){
        return response()->json(['message' => 'instructor API is working!']);
    });
    Route::middleware([RoleMiddleware::class . ':seller'])->get('/seller-dashboard',function(){
        return response()->json(['message' => 'seller API is working!']);
    });
    Route::middleware([RoleMiddleware::class . ':student'])->get('/student-dashboard',function(){
        return response()->json(['message' => 'student API is working!']);
    });
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('books', BookController::class);
Route::get('/categories/{id}/books',[BookController::class,'getBookByCategories']);
Route::get('/books/filter', [BookController::class, 'filterBooks']);
Route::apiResource('coupons', CouponController::class);

Route::get('phonepe',[PaymentController::class,'phonePe']);
// Route::post('phonepe-response',[PaymentController::class,'response'])->name('response');
// Route::post('/phonepe/initiate', [PhonePeController::class, 'initiatePayment']);
// Route::post('/phonepe/status', [PhonePeController::class, 'checkStatus']);
// Route::post('/phonepe/refund', [PhonePeController::class, 'refund']);
// Route::post('/phonepe/callback', [PhonePeController::class, 'paymentCallback'])->name('phonepe.callback');
// Route::get('/phonepe/success', function () {
//     return "Payment Successful!";
// })->name('phonepe.success');
