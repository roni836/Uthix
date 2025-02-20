<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index()
    {
        return response()->json(Vendor::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'mobile' => 'required|unique:vendors,mobile',
            'gender' => 'required|in:male,female,others',
            'dob' => 'required|date',
            'address' => 'required|string',
            'store_name' => 'required|string',
            'store_address' => 'required|string',
            'logo' => 'nullable|string',
            'school' => 'nullable|string',
            'counter' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        }

        // Step 1: Create User
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'seller'
        ]);

        // Step 2: Create Vendor linked to User
        $vendor = Vendor::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'store_address' => $request->store_address,
            'logo' => $request->logo,
            'school' => $request->school,
            'counter' => $request->counter ?? 0,
            'isApproved' => $request->isApproved ?? false,
            'status' => $request->status ?? 'pending',
        ]);

        return response()->json(['user' => $user, 'vendor' => $vendor,'message'=>'Vendor Created Successfully'], 201);
    }



    //PRODUCTS 
    public function getVendorCategories(Request $request)
    {
        $user = Auth::user(); // Authenticated Vendor
        $categories = Category::whereHas('products', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
    
        return response()->json([
            'message' => 'Categories fetched successfully',
            'categories' => $categories
        ], 200);
    }
    

    public function getVendorProducts(Request $request)
    {
        $user = Auth::user(); 
        $categoryId = $request->query('category_id'); 
    
        $query = Product::where('user_id', $user->id);
    
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
    
        $products = $query->with('category')->get();
    
        return response()->json([
            'message' => 'Products fetched successfully',
            'products' => $products
        ], 200);
    }
    public function getVendorDashboard()
{
    $user = Auth::user(); // Vendor
    
    $totalBooks = Product::where('user_id', $user->id)->count();
    $booksSold = Product::where('user_id', $user->id)->sum('num_of_sales');
    $averageRating = Product::where('user_id', $user->id)->avg('rating');

    return response()->json([
        'message' => 'Dashboard data fetched successfully',
        'data' => [
            'rating' => round($averageRating, 1),
            'total_books' => $totalBooks,
            'books_sold' => $booksSold
        ]
    ], 200);
}


}
