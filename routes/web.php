<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Artisan;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('admin/index');
});

Route::get('/login', function () {
    return view('auth.login');  
})->name('login');

// Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard'); 
Route::middleware(['auth:sanctum'])->group(function () {

Route::get('/manage-user', [AdminController::class, 'manageUser'])->name('manage.user'); 
Route::get('/insert-user', [AdminController::class, 'insertUser'])->name('insert.user'); 
Route::get('/insert-vendor', [AdminController::class, 'insertVendor'])->name('insert.vendor'); 
Route::get('/manage-vendor', [AdminController::class, 'manageVendor'])->name('manage.vendor'); 
Route::get('/manage-category', [AdminController::class, 'manageCategory'])->name('manage.category'); 
Route::get('/insert-product', [AdminController::class, 'insertProduct'])->name('insert.product'); 
Route::get('/manage-product', [AdminController::class, 'manageProduct'])->name('manage.product'); 
});

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    // Artisan::call('optimize:clear');

    return "All Caches are cleared by @Roni";
});


