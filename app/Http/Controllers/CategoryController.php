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
    public function index()
    {
        $categories = Category::all();
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
            'parent_category_id' => 'nullable|exists:categories,id',
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
            $category->parent_category_id = $request->parent_category_id;
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



    public function update(Request $request, Category $category)
    {

        $validator = Validator::make($request->all(), [
            'cat_title' => 'required|string|max:255',
            'cat_description' => 'required|string',
            'parent_category_id' => 'nullable|exists:categories,id',
            'cat_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed:', $validator->errors()->toArray());
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $imageName = $category->cat_image;

            if ($request->hasFile('cat_image') && $request->file('cat_image')->isValid()) {
                if (!empty($category->cat_image)) {
                    Storage::disk('public')->delete('image/category/' . $category->cat_image);
                }

                $image = $request->file('cat_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('image/category', $imageName, 'public');
            }

            $catTitle = $request->input('cat_title');
            if (!$catTitle) {
                throw new \Exception('cat_title is missing from the request.');
            }

            $category->update([
                'cat_title' => $catTitle,
                'cat_slug' => Str::slug($catTitle),
                'cat_description' => $request->input('cat_description'),
                'parent_category_id' => $request->input('parent_category_id'),
                'cat_image' => $imageName,
            ]);

            return response()->json([
                'message' => 'Category updated successfully',
                'category' => $category
            ], 200);
        } catch (\Exception $e) {
            Log::error('Update failed:', ['error' => $e->getMessage()]);
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
