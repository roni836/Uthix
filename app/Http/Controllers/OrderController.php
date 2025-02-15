<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\str;

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
        $orders = Order::where('user_id', $user->id)->with('orderItems')->with('orderItems')->get();
        return response()->json([
            'status' => true,
            'orders' => $orders
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'unauthorized'
            ], 401);
        }
        $cartItems = Cart::where('user_id', $user->id)->get();
        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'your cart is empty'
            ], 400);
        }
        $orderNumber = 'ORD-' . strtoupper(Str::random(8));

        $totalAmount = $cartItems->sum(function ($cart) {
            return $cart->book->price * $cart->quantity;
        });

        $orders = Order::create([
            'user_id'       => $user->id,
            'address_id'    => $request->address_id,
            'order_number'  => $orderNumber,
            'is_ordered'    => true,
            'status'        => 'pending',
            'total_amount'  => $totalAmount,
            'shipping_charge' => 50,
            'payment_status' => 'unpaid',
            'payment_method' => $request->payment_method,
            'coupon_code'   => $request->coupon_code
        ]);
        // Move cart items to OrderItems
        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id'   => $orders->id,
                'book_id'    => $cart->book_id,
                'quantity'   => $cart->quantity,
                'price'      => $cart->book->price
            ]);
        }

        // Clear the cart
        Cart::where('user_id', $user->id)->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Order placed successfully',
            'order'   => $orders
        ], 201);
    }

    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user=Auth::user();
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'unauthorized',
            ],401);
        }
        $order = Order::with('orderItems')->find($id);
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
        $user=Auth::user();
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'unauthorized',
            ],401);
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
