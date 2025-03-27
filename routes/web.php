<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PlanController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard'); 


Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/manage-class', [AdminController::class, 'manageClass'])->name('manage.class');
        Route::get('/manage-student', [AdminController::class, 'manageStudent'])->name('manage.student');
        Route::get('/insert-student', [AdminController::class, 'insertStudent'])->name('insert.student');
        Route::get('/insert-vendor', [AdminController::class, 'insertVendor'])->name('insert.vendor');
        Route::get('/manage-vendor', [AdminController::class, 'manageVendor'])->name('manage.vendor');
        Route::get('/insert-instructor', [AdminController::class, 'insertInstructor'])->name('insert.instructor');
        Route::get('/manage-instructor', [AdminController::class, 'manageInstructor'])->name('manage.instructor');
        Route::get('/manage-category', [AdminController::class, 'manageCategory'])->name('manage.category');
        Route::get('/insert-product', [AdminController::class, 'insertProduct'])->name('insert.product');
        Route::get('/manage-product', [AdminController::class, 'manageProduct'])->name('manage.product');
        Route::get('/manage-coupon', [AdminController::class, 'manageCoupon'])->name('manage.coupon');

        Route::get('/manage-plan', [AdminController::class, 'managePlan'])->name('manage.plan');
        Route::get('/insert-plan', [AdminController::class, 'insertPlan'])->name('insert.plan');
        // Route::put('/toggle-publish/{id}', [AdminController::class, 'togglePlanStatus'])->name('toggle.publish');
        Route::put('/plan/toggle-status/{id}', [PlanController::class, 'toggleStatus'])->name('toggle.plan.status');


        Route::put('/faq/toggle-status/{id}', [FaqController::class, 'toggleStatus'])->name('toggle.faq.status');

        Route::get('/manage-faq', [AdminController::class, 'manageFaq'])->name('manage.faq');
        Route::get('/insert-faq', [AdminController::class, 'insertFaq'])->name('insert.faq');

        Route::get('/help-desk', [AdminController::class, 'manageHelpDesk'])->name('manage.help-desk');
        Route::put('/query/update-status/{id}', [AdminController::class, 'updateStatusQuery'])->name('update.query.status');

        Route::get('/insert-coupon', [AdminController::class, 'insertCoupon'])->name('insert.coupon');
        Route::get('/all-orders', [AdminController::class, 'allOrders'])->name('orders.all');
        // Route::get('/admin-orders', [AdminController::class, 'adminOrders'])->name('admin.orders');
        Route::get('/admin/orders/{id}', [AdminController::class, 'orderDetails'])->name('orders.order-Details');
        Route::put('/toggle-publish/{id}', [AdminController::class, 'toggleProductStatus'])->name('toggle.publish');

    });
});
Route::post('/admin-login', [AuthController::class, 'adminLogin'])->name('admin.login');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    // Artisan::call('optimize:clear');

    return "All Caches are cleared by @Roni";
});


Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link has been created!';
});
