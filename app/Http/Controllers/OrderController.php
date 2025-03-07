<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',

            ], 401);
        }
        $orders = Order::where('user_id', $user->id)->where('is_ordered', true)->with('orderItems.product')->get();
        return response()->json([
            'status' => true,
            'orders' => $orders
        ], 200);
    }

    public function vendorOrderIndex()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Ensure user is a vendor by checking if they have products
        $productIds = Product::where('user_id', $user->id)->pluck('id');

        if ($productIds->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No orders found for this vendor.',
            ], 404);
        }

        // Fetch orders that contain the vendor's products
        $orders = Order::whereHas('orderItems', function ($query) use ($productIds) {
            $query->whereIn('product_id', $productIds);
        })->with(['orderItems.product'])->get();

        return response()->json([
            'status' => true,
            'orders' => $orders
        ], 200);
    }

    public function addToCart(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->messages(),
            ], 422);
        }

        // Find an existing cart order (is_ordered = false)
        $order = Order::where('user_id', $user->id)
            ->where('is_ordered', false)
            ->first();

        if (!$order) {
            // Create a new cart order if none exists
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'CART-' . strtoupper(Str::random(10)),
                'is_ordered' => false,
                'status' => 'pending',
                'total_amount' => 0.00,
                'shipping_charge' => 0.00,
                'payment_status' => 'unpaid',
                'payment_method' => null,
                'tracking_number' => null,
                'coupon_id' => null,
            ]);
        }

        // Check if the product is already in the cart
        $orderItem = OrderItem::where('order_id', $order->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($orderItem) {
            // Update quantity and total price
            $orderItem->update([
                'quantity' => $orderItem->quantity + $request->quantity,
                'total_price' => ($orderItem->quantity + $request->quantity) * $request->price,
            ]);
        } else {
            // Add a new item to the cart
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total_price' => $request->quantity * $request->price,
            ]);
        }

        // Update order total amount
        $totalAmount = OrderItem::where('order_id', $order->id)->sum('total_price');
        $order->update(['total_amount' => $totalAmount]);

        return response()->json([
            'status' => true,
            'message' => 'Item added to cart successfully',
        ], 201);
    }

    public function removeFromCart($id)
    {
        $user = Auth::user(); // Get authenticated user

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Find the cart order for the user
        $order = Order::where('user_id', $user->id)
            ->where('is_ordered', false)
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'No active cart found',
            ], 404);
        }

        // Find the order item
        $orderItem = OrderItem::where('order_id', $order->id)
            ->where('id', $id)
            ->first();

        if (!$orderItem) {
            return response()->json([
                'status' => false,
                'message' => 'Item not found in cart',
            ], 404);
        }

        // Delete the item from the cart
        $orderItem->delete();

        // Recalculate total amount after removal
        $totalAmount = OrderItem::where('order_id', $order->id)->sum('total_price');
        $order->update(['total_amount' => $totalAmount]);

        // If no items left in the cart, delete the order
        if ($totalAmount == 0) {
            $order->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Item removed from cart successfully',
        ], 200);
    }

    public function viewCart()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        // Find the active cart order
        $order = Order::where('user_id', $user->id)
            ->where('is_ordered', false)
            ->with('orderItems.product') // Load order items and product details
            ->first();

        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Cart is empty',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'cart' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'total_amount' => $order->total_amount,
                'items' => $order->orderItems,
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'nullable|exists:addresses,id',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'shipping_charge' => 'nullable|numeric|min:0',
            'payment_method' => 'required|string|in:cod,upi',
            'coupon_id' => 'nullable|exists:coupons,id',
            'payment_status' => 'nullable|string|in:success,failed,pending',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $user = Auth::user();

        // Generate a unique order number
        $orderNumber = 'ORD-' . strtoupper(Str::random(10));

        // Calculate total amount
        $totalAmount = collect($request->items)->sum(fn($item) => $item['quantity'] * $item['price']);

        // Check payment method
        if ($request->payment_method === 'upi') {
            if ($request->payment_status !== 'success') {
                return response()->json([
                    'status' => 400,
                    'message' => 'Payment not successful. Please try again.'
                ], 400);
            }
        }

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => $request->address_id,
            'order_number' => $orderNumber,
            'is_ordered' => true,
            'status' => 'pending',
            'total_amount' => $totalAmount,
            'shipping_charge' => $request->shipping_charge ?? 0.00,
            'payment_status' => $request->payment_method === 'cod' ? 'unpaid' : 'paid',
            'payment_method' => $request->payment_method,
            'tracking_number' => null,
            'coupon_id' => $request->coupon_id,
        ]);

        // Insert Order Items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total_price' => $item['quantity'] * $item['price'],
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully',
            'order_id' => $order->id,
            'order_number' => $order->order_number,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'unauthorized',
            ], 401);
        }
        $order = Order::with('orderItems.product')->find($id);
        $order->load('user', 'address');

        if (!$order) {
            return response()->json(['status' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'status' => true,
            'order'  => $order
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
    public function cancelOrder($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'unauthorized',
            ], 401);
        }
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'status' => false,
                'message' => 'Order not found'
            ], 404);
        }

        if ($order->status == 'completed') {
            return response()->json([
                'status' => false,
                'message' => 'Completed orders cannot be canceled'
            ], 400);
        }

        $order->update(['status' => 'canceled']);

        return response()->json([
            'status'  => true,
            'message' => 'Order canceled successfully'
        ]);
    }
}
