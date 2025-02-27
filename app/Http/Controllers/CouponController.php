<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $coupons = Coupon::all(); 
    
        if (!$coupons) {
            return response()->json([
                'status' => false,
                'message' => 'No coupons found'
            ], 404);
        }
    
        return response()->json([
            'status' => true,
            'coupons' => $coupons, // Corrected key name
        ], 200);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:4|unique:coupons,code', 
            'discount_type' => 'required|in:percentage,fixed,freeShipping',
            'discount_value' => 'required|numeric|between:0,9999.99',
            'expiration_date' => 'required|date',
            'status' => 'nullable|boolean'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Store coupon in database
        $coupon = Coupon::create($request->all());
        if(!$coupon){
            return response()->json([
                'status'=>false,
                'message'=>'coupon not found'
            ],404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Coupon created successfully',
            'data' => $coupon
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'string|max:4|unique:coupons,code,' . $id, 
            'discount_type' => 'in:percentage,fixed,freeShipping',
            'discount_value' => 'numeric|between:0,9999.99',
            'expiration_date' => 'date',
            'status' => 'boolean'
        ]);
    
        $coupon = Coupon::find($id);
    
        if (!$coupon) {
            return response()->json([
                'status' => false,
                'message' => 'Coupon not found'
            ], 404);
        }
    
        $coupon->update($request->all());
    
        return response()->json([
            'status' => true,
            'message' => 'Coupon updated successfully',
            'data' => $coupon
        ], 200);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            return response()->json(['message' => 'Coupon deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Coupon not deleted successfully'], 500);
        }  
    }
}
