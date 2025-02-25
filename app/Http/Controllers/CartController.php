<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
    
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized user'
            ], 401);
        }
    
        $product = Product::findOrFail($request->product_id);
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();
    
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }
    
        return response()->json([
            'status'  => true,
            'message' => 'Product added to cart successfully',
            'cartItem' => $cartItem,
        ], 200);
    }
    

    public function getCart()
    {
        $user = Auth::user();
        if(!$user){
            return response([
                'status'=>false,
                'message'=>'Unauthorized'
            ],401);
        }
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();
        return response()->json([
            'message' => 'Cart retrieved successfully',
            'cart' => $cartItems
        ], 200);
    }
    public function clearCart()
{
    $user = Auth::guard('sanctum')->user(); 

    if (!$user) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401); }

    Cart::where('user_id', $user->id)->delete();

    return response()->json([
        'status' => true,
        'message' => 'Cart cleared successfully'
    ], 200);
}

public function updateCart(Request $req, $cartId){
    $req->validate([
        'quantity'=>'required|integer|min:1',
    ]);

    $user=Auth::user();
    if(!$user){
        return response()->json([
            'status'=>false,
            'message'=>'unauthorized'
        ],401);

    }
    $cartItem=Cart::where('id',$cartId)->where('user_id',$user->id)->first();
    if(!$cartItem){
        return response()->json([
            'status'=>false,
            'message'=>'cart item is not found'
        ],404);
    }
    $cartItem->update(['quantity'=>$req->quantity]);
    $cartItem->load('user', 'product'); 


    return response()->json([
        'status'=>true,
        'message'=>'cart updated successfully',
        'cart'=>$cartItem,
    ],200);
}
public function removeFromCart($cartId)
    {
        $user=Auth::user();
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'unauthorized'
            ]);
        }
        $cartItem = Cart::where('id', $cartId)
                        ->where('user_id', $user->id)
                        ->first();

        if (!$cartItem) {
            return response()->json([
                'status'=>false,
                'message' => 'Cart item not found'
            ], 404);
        }

        $cartItem->delete();

        return response()->json([
            'status'=>true,
            'message' => 'Cart item removed'
        ], 200);
    }
}