<?php
namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.index');
    }

    public function manageUser(){
        return view('admin.manageUser');
    }
    
    public function insertUser(){
        return view('admin.insertUser');
    }

    public function manageVendor(){
        $vendors = Vendor::with('user')->get();
        return view('admin.manageVendor', compact('vendors'));
    }
    
    public function insertVendor(){
        return view('admin.insertVendor');
    }

    public function manageCategory(){
        $category = Category::get();
        return view('admin.manageCategory', compact('category'));
    }
    
    public function insertProduct(){
        $category = Category::get();
        return view('admin.insertProduct', compact('category'));
    }

    public function manageProduct(){
        $products = Product::get();
        return view('admin.manageProduct', compact('products'));
    }
    
}
