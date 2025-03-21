<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\Classroom;
use App\Models\Instructor;
use App\Models\Order;
use App\Models\Product;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with('user', 'coupon', 'address')->latest()->take(5)->get();
        $totalInstructors = User::where('role', 'instructor')->count();
        $totalStudents = User::where('role', 'student')->count();
        $totalSellers = User::where('role', 'seller')->count();
        $totalUsers = $totalInstructors + $totalStudents + $totalSellers;
        $previousTotalUsers = User::whereMonth('created_at', now()->subMonth()->month)->count();

        // Calculate user growth percentage
        $userGrowth = $previousTotalUsers > 0
            ? number_format((($totalUsers - $previousTotalUsers) / $previousTotalUsers) * 100, 2)
            : 0;
        // Percentage calculations
        $instructorPercentage = ($totalInstructors / max($totalUsers, 1)) * 100;
        $studentPercentage = ($totalStudents / max($totalUsers, 1)) * 100;
        $sellerPercentage = ($totalSellers / max($totalUsers, 1)) * 100;
        $orderStats = [
            'total_orders' => $orders->count(),
            'pending' => $orders->where('status', 'pending')->count(),
            'completed' => $orders->where('status', 'completed')->count(),
            'cancelled' => $orders->where('status', 'canceled')->count(),
        ];

        // $dailyOrders = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        // ->groupBy('date')
        // ->orderBy('date', 'ASC')
        // ->get();

        // $dailyOrders = Order::select(
        //     DB::raw('DAYNAME(created_at) as day'),
        //     DB::raw('COUNT(*) as count')
        // )
        //     ->groupBy('day')
        //     ->orderByRaw("FIELD(DAYNAME(created_at), 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')")
        //     ->get();

        $dailyOrders = DB::table(DB::raw("(SELECT DAYNAME(created_at) as day, COUNT(*) as count, MIN(created_at) as min_created_at FROM orders GROUP BY DAYNAME(created_at)) as subquery"))
        ->orderByRaw("FIELD(DAYNAME(min_created_at), 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')")
        ->get();
    
        $totalSales = OrderItem::sum('total_price') / 1000;

        $totalOrders = Order::count();

        $totalUsers = User::count();

        $orderPercentage = ($totalOrders > 0) ? round(($totalOrders / max($totalOrders + $totalUsers, 1)) * 100, 1) : 0;
        $userPercentage = ($totalUsers > 0) ? round(($totalUsers / max($totalOrders + $totalUsers, 1)) * 100, 1) : 0;

        $lastMonthSales = OrderItem::whereMonth('created_at', now()->subMonth()->month)->sum('total_price') / 1000;
        $salesGrowth = ($lastMonthSales > 0)
            ? round((($totalSales - $lastMonthSales) / $lastMonthSales) * 100, 1)
            : 0;


        // ✅ Total Sales This Month
        $totalSalesThisMonth = OrderItem::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_price');

        $daysPassed = Carbon::now()->day;
        $averageDailySales = ($daysPassed > 0) ? round($totalSalesThisMonth / $daysPassed, 2) : 0;


        //upcoming classes
        $upcomingClasses = Classroom::with(['instructor', 'subject'])
            ->where('schedule', '>', now())
            ->where('status', 'active')
            ->orderBy('schedule', 'asc')
            ->take(3)
            ->get();
        return view('admin.index', compact(
            'orders',
            'orderStats',
            'dailyOrders',
            'totalInstructors',
            'totalStudents',
            'totalSellers',
            'instructorPercentage',
            'studentPercentage',
            'sellerPercentage',
            'totalUsers',
            'userGrowth',
            'totalSales',
            'totalOrders',
            'totalUsers',
            'orderPercentage',
            'userPercentage',
            'salesGrowth',
            'totalSalesThisMonth',
            'averageDailySales',
            'upcomingClasses'
        ));
    }

    // public function getWeeklyOrders()
    // {
    //     $weeklyOrders = Order::select(
    //         DB::raw('DATE(created_at) as date'),
    //         DB::raw('COUNT(*) as count')
    //     )
    //     ->whereBetween('created_at', [now()->subDays(7), now()]) // Last 7 days
    //     ->groupBy('date')
    //     ->orderBy('date', 'ASC')
    //     ->get();

    //     return response()->json($weeklyOrders);
    // }


    public function manageStudent()
    {
        $users = Student::with('user')->get();
        return view('admin.student.manageStudent', compact('users'));
    }

    public function insertStudent()
    {
        return view('admin.student.insertStudent');
    }

    public function manageVendor()
    {
        $vendors = Vendor::with('user')->get();
        return view('admin.manageVendor', compact('vendors'));
    }

    public function insertVendor()
    {
        return view('admin.insertVendor');
    }

    public function manageInstructor()
    {
        $instructors = Instructor::with('user')->get();
        return view('admin.manageInstructor', compact('instructors'));
    }

    public function insertInstructor()
    {
        return view('admin.insertInstructor');
    }

    public function manageCategory()
    {
        $data['category'] = Category::get();
        $data['categories'] = Category::whereNull('parent_category_id')->get();
        return view('admin.category.manageCategory', $data);
    }


    public function insertProduct()
    {
        $category = Category::get();
        return view('admin.products.insertProduct', compact('category'));
    }

    public function manageProduct()
    {
        $perPage = 8; 
        $products = Product::simplePaginate($perPage); 
        $totalPages = ceil(Product::count() / $perPage);

        return view('admin.products.manageProduct', compact('products','totalPages'));
    }
    public function manageCoupon()
    {
        $coupons = Coupon::get();
        return view('admin.coupon.manageCoupon', compact('coupons'));
    }
    public function insertCoupon()
    {
        return view('admin.coupon.insertCoupon');
    }

    // public function allOrders()
    // {
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->back()->json([
    //             'status' => false,
    //             'message' => 'Unauthorized',

    //         ], 401);
    //     }
    //     $orders = Order::where('is_ordered', true)->with('orderItems.product')->get();

    //     return view('admin.orderList', compact('orders'));
    // }
    public function allOrders()
    {
        $orders = Order::with('user', 'coupon', 'address')->get();
        return view('admin.order.orderList', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::with('orderItems.product', 'user', 'coupon', 'address')->findOrFail($id);
        return view('admin.order.orderDetails', compact('order'));
    }


    // public function adminOrders()
    // {
    //     $user = Auth::user();
    //     if (!$user) {
    //         return redirect()->back()->json([
    //             'status' => false,
    //             'message' => 'Unauthorized',

    //         ], 401);
    //     }
    //     $orders = Order::where('user_id', $user->id)->where('is_ordered', true)->with('orderItems.product')->get();

    //     return view('admin.adminOrders', compact('orders'));
    // }

    public function manageClass()
    {
        $classes = Classroom::with('instructor', 'subject', 'chapters')->get();
        return view('admin.manageClass', compact('classes'));
    }

    public function toggleProductStatus($id)
{
    $data = Product::findOrFail($id);
    $data->is_published = !$data->is_published;
    $data->save();
    session()->flash('success', 'Product status updated successfully!');

    return back();
}

}
