<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index()
    {
        return response()->json(Vendor::all(), 200);
    }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string',
    //         'password' => 'required|min:6',
    //         'mobile' => 'required|unique:vendors,mobile',
    //         'gender' => 'required|in:male,female,others',
    //         'dob' => 'required|date',
    //         'address' => 'required|string',
    //         'store_name' => 'required|string',
    //         'store_address' => 'required|string',
    //         'logo' => 'nullable|string',
    //         'school' => 'nullable|string',
    //         'counter' => 'nullable',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 422,
    //             'error' => $validator->messages()
    //         ], 422);
    //     }

    //     // Step 1: Create User
    //     // $user = User::create([
    //     //     'name' => $request->name,
    //     //     'email' => $request->email,
    //     //     'password' => Hash::make($request->password),
    //     //     'role' => 'seller'
    //     // ]);

    //     $user = Auth::user();

    //     // Step 2: Create Vendor linked to User
    //     $vendor = Vendor::create([
    //         'user_id' => $user->id,
    //         'name' => $request->name,
    //         'mobile' => $request->mobile,
    //         'gender' => $request->gender,
    //         'dob' => $request->dob,
    //         'address' => $request->address,
    //         'store_name' => $request->store_name,
    //         'store_address' => $request->store_address,
    //         'logo' => $request->logo,
    //         'school' => $request->school,
    //         'counter' => $request->counter ?? 0,
    //         'isApproved' => $request->isApproved ?? false,
    //         'status' => $request->status ?? 'pending',
    //     ]);

    //     return response()->json(['user' => $user, 'vendor' => $vendor, 'message' => 'Vendor Created Successfully'], 201);
    // }

    public function store(Request $request)
    {
        $user = Auth::user();
    
        // Validation
        $validator = Validator::make($request->all(), [
            'store_name' => 'required|string|max:255',
            'store_address' => 'required|string',
            'mobile' => 'required|unique:vendors,mobile',
            'gender' => 'required|in:male,female,others',
            'dob' => 'nullable|date',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate logo as an image
            'school' => 'nullable|string',
            'counter' => 'nullable|integer',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }
    
        // Handle Logo Upload
        $logoPath = null;
        if ($request->hasFile('logo')) { // ✅ Changed 'cat_image' to 'logo'
            $image = $request->file('logo');
    
            if (!$image->isValid()) {
                return response()->json(['error' => 'Uploaded image is not valid.'], 400);
            }
    
            // Generate unique filename
            $logoPath = time() . '.' . $image->extension();
            $image->storeAs('images/logos', $logoPath, 'public'); // ✅ Store in 'storage/app/public/images/logos'
        }
    
        // Store Data
        $vendorStore = Vendor::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'dob' => $request->dob ? Carbon::parse($request->dob)->format('Y-m-d') : null,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'store_address' => $request->store_address,
            'logo' => $logoPath, // Save file path in DB
            'school' => $request->school,
            'counter' => $request->counter ?? 0,
            'status' => 'pending',
            'isApproved' => false,
        ]);
    
        return response()->json([
            'message' => 'Vendor store created successfully',
            'store' => $vendorStore
        ], 201);
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

        $totalProducts = Product::where('user_id', $user->id)->count();
        $productsSold = Product::where('user_id', $user->id)->sum('num_of_sales');
        $averageRating = Product::where('user_id', $user->id)->avg('rating');

        return response()->json([
            'message' => 'Dashboard data fetched successfully',
            'data' => [
                'rating' => round($averageRating, 1),
                'total_products' => $totalProducts,
                'product_sold' => $productsSold
            ]
        ], 200);
    }

    public function editSeller()
    {
        $user = Auth::user();
        $data = Vendor::where('user_id', $user->id)->first();

        return response()->json([
            'message' => 'Vendor data fetched successfully',
            'data' => $data
        ], 200);
    }

    // public function updateSeller(Request $request)
    // {
    //     $user = Auth::user();
    //     $vendor = Vendor::where('user_id', $user->id)->first();

    //     if (!$vendor) {
    //         return response()->json(['error' => 'Vendor not found'], 404);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'store_name' => 'required|string|max:255',
    //         'store_address' => 'required|string',
    //         'mobile' => 'required',
    //         'gender' => 'required|in:male,female,others',
    //         'dob' => 'nullable|date',
    //         'address' => 'nullable|string',
    //         'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'school' => 'nullable|string',
    //         'counter' => 'nullable|integer',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 422,
    //             'errors' => $validator->messages()
    //         ], 422);
    //     }

    //     // **Handle Logo Upload**
    //     $logoPath = $vendor->logo; // Retain old logo if not updated

    //     if ($request->hasFile('logo')) {
    //         $image = $request->file('logo');

    //         if (!$image->isValid()) {
    //             return response()->json(['error' => 'Uploaded image is not valid.'], 400);
    //         }

    //         // Generate unique filename and store the file
    //         $logoPath = 'images/logos/' . time() . '.' . $image->extension();
    //         $image->storeAs('public', $logoPath);

    //     }

    //     // **Update Vendor Information**
    //     $vendor->update([
    //         'user_id' => $user->id,
    //         'name' => $user->name,
    //         'mobile' => $request->mobile,
    //         'gender' => $request->gender,
    //         'dob' => $request->dob ? Carbon::parse($request->dob)->format('Y-m-d') : null,
    //         'address' => $request->address,
    //         'store_name' => $request->store_name,
    //         'store_address' => $request->store_address,
    //         'logo' => $logoPath,
    //         'school' => $request->school,
    //         'counter' => $request->counter ?? 0,
    //         'status' => 'pending',
    //         'isApproved' => false,
    //     ]);

    //     return response()->json([
    //         'message' => 'Vendor updated successfully',
    //         'store' => $vendor
    //     ], 200);
    // }


    public function updateSeller(Request $request)
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();
    
        if (!$vendor) {
            return response()->json(['error' => 'Vendor not found'], 404);
        }
    
        // Allowed fields for updating
        $allowedFields = ['name', 'mobile', 'email', 'gender', 'dob', 'address', 'school', 'counter', 'password'];
        $inputFields = array_intersect_key($request->all(), array_flip($allowedFields));
    
        // Ensure at least one field is provided for update
        if (count($inputFields) === 0) {
            return response()->json([
                'error' => 'At least one field must be provided for update.'
            ], 422);
        }
    
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'mobile' => 'digits:10',
            'email' => 'email|unique:users,email,' . $user->id,  // Fixed: Email should be checked for the user
            'gender' => 'in:male,female,others',
            'dob' => 'date',
            'address' => 'string',
            'school' => 'string',
            'counter' => 'integer',
            'password' => 'nullable|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }
    
        // Handle password separately (hash before saving)
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Update user fields
        foreach ($inputFields as $key => $value) {
            if (in_array($key, ['name', 'email', 'password', 'mobile'])) {
                $user->$key = $value;
            } else {
                $vendor->$key = $value;
            }
        }
    
        $user->save();
        $vendor->save();
    
        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
            'vendor' => $vendor
        ], 200);
    }
    
}
