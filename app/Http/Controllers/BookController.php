<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $books=Book::all();
       return response()->json([
        'message'=>'Books added successfully',
        'books'=>$books
       ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
   
    
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ['nullable', 'exists:users,id'],
            'isbn' => ['nullable', 'string', 'max:20', 'unique:books,isbn'],
            'language' => ['nullable', 'string', 'max:50'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'thumbnail_img' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Image validation
            'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'lt:price'], // Discount must be less than price
            'discount_type' => ['nullable', 'string', 'in:percentage,fixed'],
            'stock' => ['required', 'integer', 'min:0'],
            'min_qty' => ['required', 'integer', 'min:1'],
            'is_featured' => ['boolean'],
            'is_published' => ['boolean'],
            'num_of_sales' => ['integer', 'min:0'],
        ]);
    
        try {
            // Image Handling
            $imageName = null;
            if ($request->hasFile('thumbnail_img')) {
                $image = $request->file('thumbnail_img');
                $imageName = time() . '.' . $image->extension();
                $image->storeAs('image/books', $imageName, 'public');
            }
    
            // Create the book record
            $book = Book::create([
                'title' => $request->title,
                'author' => $request->author,
                'category_id' => $request->category_id,
                'user_id' => $request->user_id,
                'isbn' => $request->isbn,
                'language' => $request->language ?? 'English',
                'pages' => $request->pages,
                'description' => $request->description,
                'thumbnail_img' => $imageName, 
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
    
            return response()->json([
                'message' => 'Book created successfully!',
                'book' => $book
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
    public function show($slug)
    {
        $book = Book::where('slug', $slug)->first();

        if (!$book) {
            return response()->json([
                'message' => 'book not found'
            ], 404);
        }

        return response()->json([
            'message' => 'book retrieved successfully',
            'book' => $book
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
   

public function update(Request $request, $id)
{
    // Find the book or return error
    $book = Book::find($id);
    if (!$book) {
        return response()->json(['message' => 'Book not found.'], 404);
    }

    // Validation rules
    $request->validate([
        'title' => ['sometimes', 'string', 'max:255'],
        'author' => ['sometimes', 'string', 'max:255'],
        'category_id' => ['sometimes', 'exists:categories,id'],
        'user_id' => ['nullable', 'exists:users,id'],
        'isbn' => ['nullable', 'string', 'max:20', 'unique:books,isbn,' . $id], // Unique ISBN except current book
        'language' => ['nullable', 'string', 'max:50'],
        'pages' => ['nullable', 'integer', 'min:1'],
        'description' => ['nullable', 'string'],
        'thumbnail_img' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Image validation
        'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
        'price' => ['sometimes', 'numeric', 'min:0'],
        'discount_price' => ['nullable', 'numeric', 'lt:price'], // Discount must be less than price
        'discount_type' => ['nullable', 'string', 'in:percentage,fixed'],
        'stock' => ['sometimes', 'integer', 'min:0'],
        'min_qty' => ['sometimes', 'integer', 'min:1'],
        'is_featured' => ['boolean'],
        'is_published' => ['boolean'],
        'num_of_sales' => ['integer', 'min:0'],
    ]);

    try {
        // Handle Image Update
        if ($request->hasFile('thumbnail_img')) {
            // Delete the old image if exists
            if ($book->thumbnail_img) {
                Storage::disk('public')->delete('images/books/' . $book->thumbnail_img);
            }

            // Store new image
            $image = $request->file('thumbnail_img');
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('images/books', $imageName, 'public');
            $book->thumbnail_img = $imageName;
        }

        // Update fields if provided
        $book->title = $request->title ?? $book->title;
        $book->author = $request->author ?? $book->author;
        $book->category_id = $request->category_id ?? $book->category_id;
        $book->user_id = $request->user_id ?? $book->user_id;
        $book->isbn = $request->isbn ?? $book->isbn;
        $book->language = $request->language ?? $book->language;
        $book->pages = $request->pages ?? $book->pages;
        $book->description = $request->description ?? $book->description;
        $book->rating = $request->rating ?? $book->rating;
        $book->price = $request->price ?? $book->price;
        $book->discount_price = $request->discount_price ?? $book->discount_price;
        $book->discount_type = $request->discount_type ?? $book->discount_type;
        $book->stock = $request->stock ?? $book->stock;
        $book->min_qty = $request->min_qty ?? $book->min_qty;
        $book->is_featured = $request->is_featured ?? $book->is_featured;
        $book->is_published = $request->is_published ?? $book->is_published;
        $book->num_of_sales = $request->num_of_sales ?? $book->num_of_sales;
        $book->slug = Str::slug($request->title ?? $book->title); // Update slug if title changes

        $book->save();

        return response()->json([
            'message' => 'Book updated successfully!',
            'book' => $book
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
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return response()->json(['message' => 'Book deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Book not deleted successfully'], 500);
        }
    }
}
