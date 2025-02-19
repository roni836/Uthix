<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'message' => 'products added successfully',
            'products' => $products
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */


     public function store(Request $request)
     {
         $user = Auth::user();
     
         // Validation
         $request->validate([
             'title' => ['required', 'string', 'max:255'],
             'author' => ['required', 'string', 'max:255'],
             'category_id' => ['required', 'exists:categories,id'],
             'user_id' => ['nullable', 'exists:users,id'],
             'isbn' => ['nullable', 'string', 'max:20', 'unique:products,isbn'],
             'language' => ['nullable', 'string', 'max:50'],
             'pages' => ['nullable', 'integer', 'min:1'],
             'description' => ['nullable', 'string'],
             'thumbnail_img' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
             'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
             'price' => ['required', 'numeric', 'min:0'],
             'discount_price' => ['nullable', 'numeric', 'lt:price'],
             'discount_type' => ['nullable', 'string', 'in:percentage,fixed'],
             'stock' => ['required', 'integer', 'min:0'],
             'min_qty' => ['required', 'integer', 'min:1'],
             'is_featured' => ['boolean'],
             'is_published' => ['boolean'],
             'num_of_sales' => ['integer', 'min:0'],
             'images.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'], // Multiple image validation
         ]);
     
         try {
             // Store Thumbnail Image
             $thumbnailImage = null;
             if ($request->hasFile('thumbnail_img')) {
                 $image = $request->file('thumbnail_img');
                 $thumbnailImage = time() . '.' . $image->extension();
                 $image->storeAs('image/products', $thumbnailImage, 'public');
             }
     
             // Create the Product
             $product = Product::create([
                 'title' => $request->title,
                 'author' => $request->author,
                 'category_id' => $request->category_id,
                 'user_id' => $user->id,
                 'isbn' => $request->isbn,
                 'language' => $request->language ?? 'English',
                 'pages' => $request->pages,
                 'description' => $request->description,
                 'thumbnail_img' => $thumbnailImage,
                 'rating' => $request->rating ?? 0.00,
                 'price' => $request->price,
                 'discount_price' => $request->discount_price,
                 'discount_type' => $request->discount_type,
                 'stock' => $request->stock,
                 'min_qty' => $request->min_qty ?? 1,
                 'is_featured' => $request->is_featured ?? false,
                 'is_published' => $request->is_published ?? true,
                 'num_of_sales' => $request->num_of_sales ?? 0,
                 'slug' => Str::slug($request->title),
             ]);
     
             // Store Multiple Images
             if ($request->hasFile('images')) {
                 foreach ($request->file('images') as $image) {
                     $imageName = time() . rand(1000, 9999) . '.' . $image->extension();
                     $image->storeAs('image/products', $imageName, 'public');
     
                     ProductImage::create([
                         'product_id' => $product->id,
                         'image_path' => $imageName,
                     ]);
                 }
             }
     
             return response()->json([
                 'message' => 'Product created successfully!',
                 'product' => $product,
                 'images' => $product->images // Returning images with response
             ], 201);
         } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Something went wrong.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }
     


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->with('images')->first();

        if (!$product) {
            return response()->json([
                'message' => 'product not found'
            ], 404);
        }

        return response()->json([
            'message' => 'product retrieved successfully',
            'product' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */


     public function update(Request $request, $id)
     {
         $user = Auth::user();
         $product = Product::find($id);
     
         if (!$product) {
             return response()->json(['message' => 'Product not found.'], 404);
         }
     
         // Validation rules
         $request->validate([
             'title' => ['sometimes', 'string', 'max:255'],
             'author' => ['sometimes', 'string', 'max:255'],
             'category_id' => ['sometimes', 'exists:categories,id'],
             'user_id' => ['nullable', 'exists:users,id'],
             'isbn' => ['nullable', 'string', 'max:20', 'unique:products,isbn,' . $id], 
             'language' => ['nullable', 'string', 'max:50'],
             'pages' => ['nullable', 'integer', 'min:1'],
             'description' => ['nullable', 'string'],
             'thumbnail_img' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
             'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
             'price' => ['sometimes', 'numeric', 'min:0'],
             'discount_price' => ['nullable', 'numeric', 'lt:price'],
             'discount_type' => ['nullable', 'string', 'in:percentage,fixed'],
             'stock' => ['sometimes', 'integer', 'min:0'],
             'min_qty' => ['sometimes', 'integer', 'min:1'],
             'is_featured' => ['boolean'],
             'is_published' => ['boolean'],
             'num_of_sales' => ['integer', 'min:0'],
             'images.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Validate multiple images
         ]);
     
         try {
             if ($request->hasFile('thumbnail_img')) {
                 if ($product->thumbnail_img) {
                     Storage::disk('public')->delete('images/products/' . $product->thumbnail_img);
                 }
     
                 $image = $request->file('thumbnail_img');
                 $imageName = time() . '.' . $image->extension();
                 $image->storeAs('images/products', $imageName, 'public');
                 $product->thumbnail_img = $imageName;
             }
     
             // ✅ Handle Multiple Images Update
             if ($request->hasFile('images')) {
                 // Optional: Delete old images if necessary
                 $oldImages = ProductImage::where('product_id', $product->id)->get();
                 foreach ($oldImages as $oldImage) {
                     Storage::disk('public')->delete('images/products/' . $oldImage->image_path);
                     $oldImage->delete();
                 }
     
                 // Upload new images
                 foreach ($request->file('images') as $image) {
                     $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                     $image->storeAs('images/products', $imageName, 'public');
     
                     // Save new image in database
                     ProductImage::create([
                         'product_id' => $product->id,
                         'image_path' => $imageName,
                     ]);
                 }
             }
     
             // ✅ Update other fields only if provided
             $product->title = $request->title ?? $product->title;
             $product->author = $request->author ?? $product->author;
             $product->category_id = $request->category_id ?? $product->category_id;
             $product->user_id = $user->id ?? $product->user_id;
             $product->isbn = $request->isbn ?? $product->isbn;
             $product->language = $request->language ?? $product->language;
             $product->pages = $request->pages ?? $product->pages;
             $product->description = $request->description ?? $product->description;
             $product->rating = $request->rating ?? $product->rating;
             $product->price = $request->price ?? $product->price;
             $product->discount_price = $request->discount_price ?? $product->discount_price;
             $product->discount_type = $request->discount_type ?? $product->discount_type;
             $product->stock = $request->stock ?? $product->stock;
             $product->min_qty = $request->min_qty ?? $product->min_qty;
             $product->is_featured = $request->is_featured ?? $product->is_featured;
             $product->is_published = $request->is_published ?? $product->is_published;
             $product->num_of_sales = $request->num_of_sales ?? $product->num_of_sales;
             $product->slug = Str::slug($request->title ?? $product->title);
     
             $product->save();
     
             return response()->json([
                 'message' => 'Product updated successfully!',
                 'product' => $product,
                 'images' => ProductImage::where('product_id', $product->id)->get(),
             ], 200);
     
         } catch (\Exception $e) {
             return response()->json([
                 'message' => 'Something went wrong.',
                 'error' => $e->getMessage()
             ], 500);
         }
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $user = Auth::user();

        if ($user->role === 'seller' && $product->user_id !== $user->id) {
            return response()->json([
                'message' => 'You do not have permission to delete this product.',
            ], 403);
        }

        if ($user->role !== 'admin' && $user->role !== 'seller') {
            return response()->json([
                'message' => 'You do not have permission to delete a product.',
            ], 403);
        }
        try {
            $product->delete();
            return response()->json(['message' => 'product deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'product not deleted successfully'], 500);
        }
    }


    public function getproductByCategories(Request $request, $id)
    {
        $query = Product::where('category_id', $id);

        // Price range filters
        $priceRanges = [
            'below_500' => [0, 500],
            '500_1000' => [500, 1000],
            '1000_1500' => [1000, 1500],
            '1500_2000' => [1500, 2000],
            '2000_2500' => [2000, 2500],
            'above_2500' => [2501, null]
        ];
        // search
        if ($request->has('search')) {
            $searchproducts = $request->input('search');
            $query->where(function ($q) use ($searchproducts) {
                $q->where('title', 'like', '%' . $searchproducts . '%')
                    ->orWhere('description', 'like', '%' . $searchproducts . '%')
                    ->orWhere('author', 'like', '%' . $searchproducts . '%')
                    ->orWhere('language', 'like', '%' . $searchproducts . '%');
            });
        }

        // Apply price range filtering if requested
        if ($request->has('price_range')) {
            $selectedPriceRanges = explode(',', $request->input('price_range')); // Expect comma-separated values

            $query->where(function ($q) use ($selectedPriceRanges, $priceRanges) {
                foreach ($selectedPriceRanges as $range) {
                    if (isset($priceRanges[$range])) {
                        [$min, $max] = $priceRanges[$range];

                        if ($max !== null) {
                            $q->orWhereBetween('discount_price', [$min, $max]);
                        } else {
                            $q->orWhere('discount_price', '>=', $min);
                        }
                    }
                }
            });
        }

        // Fetch filtered products
        $products = $query->get();

        // If no products found
        if ($products->isEmpty()) {
            return response()->json([
                'message' => 'No products found in this category',
                'products' => []
            ], 404);
        }

        // Get min and max price from the filtered products
        $minPrice = $products->min('discount_price');
        $maxPrice = $products->max('discount_price');

        return response()->json([
            'message' => 'products retrieved successfully',
            'products' => $products,
            'min_price' => $minPrice,
            'max_price' => $maxPrice
        ], 200);
    }
}
