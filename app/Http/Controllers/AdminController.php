<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function manageUser(){
        return view('admin.manageUser');
    }
    
    public function insertUser(){
        return view('admin.insertUser');
    }
    
}
