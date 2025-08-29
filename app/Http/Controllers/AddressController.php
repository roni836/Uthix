<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'Unauthorized',
            ],404);
        }
        $address=Address::where('user_id',$user->id)->get();
        return response()->json([
            'status'=>true,
            'address'=>$address
        ],200);


    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|min:3|max:255',
            'phone'        => 'required|digits:10|numeric',
            'alt_phone'    => 'nullable|digits:10|numeric',
            'address_type' => 'required|in:home,office,other',
            'landmark'     => 'required|string|min:3|max:255',
            'street'       => 'required|string|min:3|max:255',
            'area'         => 'required|string|min:3|max:255',
            'postal_code'  => 'required|digits:6|numeric',
        ]);
    
        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }
    
        // $pincode = $request->postal_code;
        // $response = Http::get("https://api.postalpincode.in/pincode/{$pincode}");
        // $data = $response->json();
    
        // if (!isset($data[0]) || !isset($data[0]['Status']) || $data[0]['Status'] !== 'Success') {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Invalid Pincode or API issue'
        //     ], 400);
        // }
    
        // $city = $data[0]['PostOffice'][0]['District'] ?? 'Unknown';
        // $state = $data[0]['PostOffice'][0]['State'] ?? 'Unknown';
        // $country = 'India'; // Static for this API
    
        // Store address in database
       $address= Address::create([
            'user_id'      => $user->id,
            'name'         => $request->name,
            'phone'        => $request->phone,
            'alt_phone'    => $request->alt_phone,
            'address_type' => $request->address_type,
            'landmark'     => $request->landmark,
            'street'       => $request->street,
            'area'         => $request->area,
            'postal_code'  => $request->pincode,
            'city'         => $request->city,
            'state'        => $request->state,
            'country'      => $request->country,
            // 'is_default'   => $request->is_default
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Address saved successfully',
            'data' => [
                'address'=>$address
            ]
        ], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        // Validate request data
        $request->validate([
            'name'         => 'sometimes|required|string|min:3|max:255',
            'phone'        => 'sometimes|required|digits:10|numeric',
            'alt_phone'    => 'nullable|digits:10|numeric',
            'address_type' => 'sometimes|required|in:home,office,other',
            'landmark'     => 'sometimes|required|string|min:3|max:255',
            'street'       => 'sometimes|required|string|min:3|max:255',
            'area'         => 'sometimes|required|string|min:3|max:255',
            'postal_code'  => 'sometimes|required|digits:6|numeric',
            'is_default'   => 'sometimes|boolean'
        ]);
    
        // Check if authenticated user owns this address
        if (Auth::id() !== $address->user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
    
        // If postal code is updated, fetch new city & state
        if ($request->has('postal_code')) {
            $pincode = $request->postal_code;
            $response = Http::get("https://api.postalpincode.in/pincode/{$pincode}");
            $data = $response->json();
    
            if (!isset($data[0]) || $data[0]['Status'] !== 'Success') {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid Pincode or API issue'
                ], 400);
            }
    
            $request->merge([
                'city' => $data[0]['PostOffice'][0]['District'] ?? 'Unknown',
                'state' => $data[0]['PostOffice'][0]['State'] ?? 'Unknown',
            ]);
        }
    
        // Update address with only provided fields
        $address->update($request->only([
            'name', 'phone', 'alt_phone', 'address_type', 'landmark', 'street',
            'area', 'postal_code', 'city', 'state', 'is_default'
        ]));
    
        return response()->json([
            'status' => true,
            'message' => 'Address updated successfully',
            'data' => $address
        ]);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=Auth::user();
        if(!$user){
            return response()->json([
                'status'=>false,
                'message'=>'unauthorized'
            ],401);
        }
        $address=Address::where('id',$id)->where('user_id', $user->id);
        if(!$address){
            return response()->json([
                'status'=>false,
                'message'=>'Address not found',

            ]);
            
        }
        $address->delete();
        return response()->json([
            'status'=>true,
            'message'=>"Address deleted successfully"
        ]);

    }
}
