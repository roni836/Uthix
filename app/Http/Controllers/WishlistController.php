<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $wishlists = Wishlist::with(['product.firstImage'])->where('user_id', $user->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'User wishlist fetched successfully',
            'wishlists' => $wishlists,
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $productId = $request->input('product_id');

        $wishlistItem = Wishlist::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            return response()->json([
                'status' => true,
                'message' => 'product removed from wishlist successfully'
            ]);
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'product added to wishlist successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user(); // Get authenticated user

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $wishlistItem = Wishlist::where('id', $id)
            ->where('user_id', $user->id)
            ->first();
        if (!$wishlistItem) {
            return response()->json([
                'status' => false,
                'message' => 'Wishlist item not found'
            ], 404);
        }
        $wishlistItem->delete();
        return response()->json([
            'status' => true,
            'message' => 'wishlist item removed successfully'
        ]);
    }
}
