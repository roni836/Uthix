<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();
        if($request->has('search')){
            $searchcategories=$request->input('search');
            $query->where(function($q) use ($searchcategories){
                $q->where('cat_title','like', '%'.$searchcategories. '%');
            });
        }
        $categories = $query->get();
         // If no books found
    if ($categories->isEmpty()) {
        return response()->json([
            'message' => 'No categories found',
            'books' => []
        ], 404);
    }
        return response()->json([
            'message' => 'Categories fetched successfully',
            'categories' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'cat_title' => 'required|string|max:255',
            'cat_description' => 'required|string',
            // 'parent_category_id' => 'nullable|exists:categories,id',
            'cat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('cat_image')) {
            $image = $request->file('cat_image');

            if (!$image->isValid()) {
                return response()->json(['error' => 'Uploaded image is not valid.'], 400);
            }

            $imageName = time() . '.' . $image->extension();
            $image->storeAs('image/category', $imageName, 'public');
        }

        try {
            $catSlug = str::slug($request->cat_title);

            $category = new Category();
            $category->cat_title = $request->cat_title;
            // $category->parent_category_id = $request->parent_category_id;
            $category->cat_slug = $catSlug;
            $category->cat_description = $request->cat_description;
            $category->cat_image = $imageName;
            $category->save();


            return response()->json([
                'message' => 'Category created successfully',
                'category' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function show($id)
    {
        $category = Category::where('id', $id)->first();

        if (!$category) {
            return response()->json([
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Category retrieved successfully',
            'category' => $category
        ], 200);
    }


  
    public function update(Request $request, $id)
{
    Log::info('Update request received', $request->except('cat_image'));

    // Find category by ID
    $category = Category::findOrFail($id);

    // Validation rules
    $validator = Validator::make($request->all(), [
        'cat_title' => 'nullable|string|max:255',
        'cat_description' => 'nullable|string',
        // 'parent_category_id' => 'nullable|integer|exists:categories,id',
        'cat_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        Log::error('Validation failed', ['errors' => $validator->errors()->toArray()]);
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }

    try {
        $updateData = [];

        // Check and update fields if present
        if ($request->has('cat_title')) {
            $updateData['cat_title'] = $request->input('cat_title');
            $updateData['cat_slug'] = Str::slug($request->input('cat_title'));
        }

        if ($request->has('cat_description')) {
            $updateData['cat_description'] = $request->input('cat_description');
        }

        // if ($request->has('parent_category_id')) {
        //     $updateData['parent_category_id'] = $request->input('parent_category_id');
        // }

        // Handle image update
        if ($request->hasFile('cat_image')) {
            $image = $request->file('cat_image');

            if ($image->isValid()) {
                // Delete old image if exists
                if (!empty($category->cat_image)) {
                    Storage::disk('public')->delete('image/category/' . $category->cat_image);
                }

                // Store new image
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('image/category', $imageName, 'public');
                $updateData['cat_image'] = $imageName;
            } else {
                throw new \Exception('Uploaded file is not valid.');
            }
        }

        // Only update if there is something to update
        if (!empty($updateData)) {
            $category->update($updateData);
        }

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category
        ], 200);

    } catch (\Exception $e) {
        Log::error('Update failed', ['error' => $e->getMessage()]);
        return response()->json([
            'message' => 'Something went wrong',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    
    
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Category not deleted successfully'], 500);
        }
    }
}
