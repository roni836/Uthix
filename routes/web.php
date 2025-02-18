<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('admin/index');
});

Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard'); 

Route::get('/manage-user', [AdminController::class, 'manageUser'])->name('manage.user'); 
Route::get('/insert-user', [AdminController::class, 'insertUser'])->name('insert.user'); 
Route::get('/insert-vendor', [AdminController::class, 'insertVendor'])->name('insert.vendor'); 
Route::get('/manage-vendor', [AdminController::class, 'manageVendor'])->name('manage.vendor'); 
Route::get('/manage-category', [AdminController::class, 'manageCategory'])->name('manage.category'); 

