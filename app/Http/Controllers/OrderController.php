<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
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
         $totalAmount = collect($request->items)->sum(fn ($item) => $item['quantity'] * $item['price']);
     
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
