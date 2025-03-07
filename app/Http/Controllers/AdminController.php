<?php
namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Instructor;
use App\Models\Product;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.index');
    }

    public function manageStudent(){
        $users = Student::with('user')->get();
        return view('admin.manageStudent', compact('users'));
    }
    
    public function insertStudent(){
        return view('admin.insertStudent');
    }

    public function manageVendor(){
        $vendors = Vendor::with('user')->get();
        return view('admin.manageVendor', compact('vendors'));
    }
    
    public function insertVendor(){
        return view('admin.insertVendor');
    }

    public function manageInstructor(){
        $instructors = Instructor::with('user')->get();
        return view('admin.manageInstructor', compact('instructors'));
    }
    
    public function insertInstructor(){
        return view('admin.insertInstructor');
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
    public function manageCoupon(){
        $coupons = Coupon::get();
        return view('admin.coupon.manageCoupon', compact('coupons'));
    }
    public function insertCoupon(){
        return view('admin.coupon.insertCoupon');
    }
    
}
