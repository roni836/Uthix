<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
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
                'message' => 'Unauthorized'
            ], 401);
        }
    
        $cartItems = Cart::where('user_id', $user->id)->get();
        if ($cartItems->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Your cart is empty'
            ], 400);
        }
    
        $orderNumber = 'ORD-' . strtoupper(Str::random(8));
    
        // Calculate initial total amount
        $totalAmount = $cartItems->sum(function ($cart) {
            return $cart->product->price * $cart->quantity;
        });
    
        $shippingCharge = 50; // Default shipping charge
        $discountAmount = 0;
    
        // Check if a coupon is provided and apply discount
        if ($request->coupon_id) {
            $coupon = Coupon::where('id', $request->coupon_id)
                            ->where('status', true)
                            ->whereDate('expiration_date', '>=', now())
                            ->first();
    
            if ($coupon) {
                if ($coupon->discount_type === 'percentage') {
                    $discountAmount = ($totalAmount * $coupon->discount_value) / 100;
                } elseif ($coupon->discount_type === 'fixed') {
                    $discountAmount = $coupon->discount_value;
                } elseif ($coupon->discount_type === 'freeShipping') {
                    $shippingCharge = 0; // Free shipping
                }
    
                // Ensure total amount doesn't go negative
                $totalAmount = max(0, $totalAmount - $discountAmount);
            }
        }
    
        // Create order
        $order = Order::create([
            'user_id'       => $user->id,
            'address_id'    => $request->address_id,
            'order_number'  => $orderNumber,
            'is_ordered'    => true,
            'status'        => 'pending',
            'total_amount'  => $totalAmount,
            'shipping_charge' => $shippingCharge,
            'payment_status' => 'unpaid',
            'payment_method' => $request->payment_method,
            'coupon_id'     => $request->coupon_id // Storing the applied coupon
        ]);
    
        // Move cart items to OrderItems
        foreach ($cartItems as $cart) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id'    => $cart->product_id,
                'quantity'   => $cart->quantity,
                'price'      => $cart->product->price
            ]);
        }
    
        // Clear the cart
        Cart::where('user_id', $user->id)->delete();
    
        return response()->json([
            'status'  => true,
            'message' => 'Order placed successfully',
            'order'   => $order
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
