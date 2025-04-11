<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer'   => 'nullable|string',
            'type'     => 'required|in:seller,student,instructor', 


        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $faq = Faq::create($request->all());
        return response()->json(['message' => 'FAQ added successfully', 'faq' => $faq], 201);
    }

    public function show($id)
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }
        return response()->json($faq);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer'   => 'nullable|string',
            'type'     => 'in:seller,student,instructor', // added

            'status'   => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $faq->update($request->all());
        return response()->json(['message' => 'FAQ updated successfully', 'faq' => $faq]);
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }

        $faq->delete();
        return response()->json(['message' => 'FAQ deleted successfully']);
    }
    public function onlyShowActiveFAQs()
    {
        $faqs = Faq::where('status', true)->get();
    
        if ($faqs->isEmpty()) {
            return response()->json(['message' => 'No active FAQs found'], 404);
        }
    
        return response()->json($faqs);
    }
    public function toggleStatus($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->status = !$faq->status; 
        $faq->save();
    
        return back()->with('success', 'faq status updated successfully!');
    }
    
}
