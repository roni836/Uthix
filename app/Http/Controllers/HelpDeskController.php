<?php

namespace App\Http\Controllers;

use App\Models\HelpDesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $query = HelpDesk::create([
            'user_id' => auth()->id(), 
            'subject' => $request->subject,
            'description' => $request->description,
        ]);
    
        return response()->json(['message' => 'Query submitted successfully', 'query' => $query]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(HelpDesk $helpDesk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HelpDesk $helpDesk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HelpDesk $helpDesk)
    {
        //
    }
}
