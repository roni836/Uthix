<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Order;
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

    public function adminStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'phone' => $request->phone,
            'password' => Hash::make($request->password ?? '123456789'),
            'role' => 'seller'
        ]);

        $vendor = Vendor::create([
            'user_id' => $user->id,
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

        return response()->json(['user' => $user, 'vendor' => $vendor, 'message' => 'Vendor Created Successfully'], 201);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $vendor = Vendor::where('user_id', $user->id)->first();

        // Validation
        $validator = Validator::make($request->all(), [
            'store_name' => 'required|string|max:255',
            'store_address' => 'required|string',
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
        $vendorStore = $vendor->update([
            'store_name' => $request->store_name,
            'store_address' => $request->store_address,
            'logo' => $logoPath,
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

        $products = $query->with('category','images')->get();

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
        $data = Vendor::where('user_id', $user->id)->with('user')->first();

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

    public function vendorStoreStatus()
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        if (!$vendor) {
            return response()->json(['error' => 'Vendor not found'], 404);
        }

        if ($vendor->store_name) {
            return response()->json([
                'status' => true
            ], 200);
        } else {
            return response()->json([
                'status' => false
            ], 200);
        }
    }


    public function updateSeller(Request $request)
    {
        $data = Auth::user();
        $vendor = Vendor::where('user_id', $data->id)->first();
        $user = User::where('id', $data->id)->first();

        if (!$vendor) {
            return response()->json(['error' => 'Vendor not found'], 404);
        }

        // Validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');

            if (!$image->isValid()) {
                return response()->json(['error' => 'Uploaded image is not valid.'], 400);
            }

            $profileImage = time() . '.' . $image->extension();

            $image->storeAs('images/instructor/profile_image', $profileImage, 'public');
        }

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $vendor->update([
            'gender' => $request->gender,
            'dob' => $request->dob ? Carbon::parse($request->dob)->format('Y-m-d') : null,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'store_address' => $request->store_address,
            'school' => $request->school,
            'counter' => $request->counter ?? 0,
            'status' => 'pending',
            'isApproved' => false,
            'profile_image' => $profileImage,
        ]);


        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user,
            'vendor' => $vendor
        ], 200);
    }

    public function vendorOrderStatus($status)
    {

        $user = Auth::user();
        // Ensure user is a vendor by checking if they have products
        $productIds = Product::where('user_id', $user->id)->pluck('id');

        if ($productIds->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No orders found for this vendor.',
            ], 404);
        }

        // Fetch orders that contain the vendor's products
        $orders = Order::where('status', $status)->whereHas('orderItems', function ($query) use ($productIds) {
            $query->whereIn('product_id', $productIds);
        })->with(['orderItems.product'])->get();

        return response()->json([
            'status' => true,
            'orders' => $orders
        ], 200);
    }

    public function vendorUpdateOrderStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'status' => 'required|string', // assuming status is a string like 'delivered'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $productId = $request->product_id;
        $newStatus = $request->status;

        // Find all orders that have this product
        $orders = Order::whereHas('orderItems', function ($query) use ($productId) {
            $query->where('product_id', $productId);
        })
            ->with(['orderItems.product'])
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No orders found for this product.',
            ], 404);
        }

        // Update each order's status
        foreach ($orders as $order) {
            $order->status = $newStatus;
            $order->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Order status updated successfully.',
            'updated_orders' => $orders
        ], 200);
    }
}
