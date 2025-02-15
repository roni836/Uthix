<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized user'
            ], 401);
        }
    
        $book = Book::findOrFail($request->book_id);
        $cartItem = Cart::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();
    
        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cartItem = Cart::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
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
        $cartItems = Cart::with('book')->where('user_id', $user->id)->get();
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
    $cartItem->load('user', 'book'); 


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