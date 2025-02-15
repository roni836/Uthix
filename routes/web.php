<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('admin/index');
});

Route::get('/manage-user', function () {
    return view('admin/manageUser');
});
Route::get('/insert-user', function () {
    return view('admin/insertUser');
});
