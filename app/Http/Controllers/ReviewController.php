<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
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
    
        $reviews = Review::where('user_id', $user->id)->get();
    
        return response()->json([
            'status' => true,
            'message' => 'User reviews fetched successfully',
            'reviews' => $reviews
        ]);
    }

    public function vendorIndex($product_id)
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $reviews = Review::where('product_id', $product_id)->get();
    
        return response()->json([
            'status' => true,
            'message' => 'User reviews fetched successfully',
            'reviews' => $reviews
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validate request
        $validator = Validator::make($request->all(), [
            'product_id' => ['bail', 'required', 'exists:products,id'],
            'rating' => ['bail', 'required', 'integer', 'min:1', 'max:5'],
            'review' => ['nullable', 'string'],
            'images' => ['sometimes', 'array'], // Ensures 'images' is an array if present
            'images.*' => ['sometimes', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Validate each image in array
        ]);
        
        // Check validation and return errors if any
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create Review
        $review = Review::create([
            'product_id' => $request->product_id,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        // Store Multiple Images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('images/reviews', $imageName, 'public');

                ReviewImage::create([
                    'review_id' => $review->id,
                    'image_path' => $imageName,
                ]);
            }
        }

        return response()->json([
            'message' => 'Review submitted successfully!',
            'review' => $review->load('images')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
