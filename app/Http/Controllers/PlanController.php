<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['plans'] = plan::all();
        return response()->json([
            'message'=>'success',
            'data'=>$data

        ]);
    }

    public function store(Request $request)
    {
      $validator= Validator::make($request->all(),[
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'duration' => 'required|string|in:monthly,yearly',
        'features' => 'required|array'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }
        $plan = Plan::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'features' => json_encode($request->features), 
        ]);        return response()->json([
            'message'=>'Plan created successfully',
            'data'=>$plan
        ]);
       
    }

    public function showPlanForStudent()
    {
        $data['plans'] = plan::where('duration', 'monthly')->where('status',1)->get();
        return response()->json([
            'message'=>'success',
            'data'=>$data

        ]);
    }

  
}
