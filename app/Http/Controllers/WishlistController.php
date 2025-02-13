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
       $user=Auth::user();
       if(!$user){
        return response()->json(['error'=>'Unauthorized'],401);

       }
       $wishlists=Wishlist::where('user_id',$user->id)->with('book')->get();
       return response()->json([
        'status'=>true,
        'message'=>'user wishlist fetched successfully',
        'wishlists'=>$wishlists
       ],200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Wishlist $wishlist)
    {
        //
    }
}
