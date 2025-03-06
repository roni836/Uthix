<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['subjects'] = Subject::all();
        return response()->json($data, 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name',
            'is_active' => 'nullable|boolean',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        }
    
        // Store the subject
        $subject = Subject::create([
            'name' => $request->name,
            'is_active' => $request->is_active ?? true, 
        ]);
    
        return response()->json([
            'status' => true,
            'message' => 'Subject created successfully',
            'data' => $subject
        ], 201);
    }

    public function update(Request $request, Subject $subject)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:subjects,name,' . $subject->id,
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ], 422);
        }

        // Update subject
        $subject->update([
            'name' => $request->name,
            'is_active' => $request->is_active ?? $subject->is_active,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subject updated successfully',
            'data' => $subject
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'status' => true,
            'message' => 'Subject deleted successfully'
        ], 200);
    }}
