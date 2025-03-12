<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\GradeDetail;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function storeGrades(Request $request, $uploadId)
    {
        $instructorId = Instructor::where('user_id', auth()->id())->value('id');
    
        $data = json_decode($request->getContent(), true);
        if (!$data) {
            return response()->json(['error' => 'Invalid JSON format'], 400);
        }
    
        $validator = Validator::make($data, [
            'grades' => 'required|array',
            'grades.*.criterion' => 'required|string',
            'grades.*.grade' => 'required|in:Excellent,Well Done,Basic',
            'feedback_note' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
    
        $grade = Grade::updateOrCreate(
            ['assignment_upload_id' => $uploadId, 'instructor_id' => $instructorId],
            ['feedback_note' => $data['feedback_note'] ?? null]
        );
    
        GradeDetail::where('grade_id', $grade->id)->delete();
    
        foreach ($data['grades'] as $detail) {
            GradeDetail::create([
                'grade_id' => $grade->id,
                'criterion' => $detail['criterion'],
                'grade' => $detail['grade'],
            ]);
        }
    
        return response()->json([
            'status' => true,
            'message' => 'Grading submitted successfully!',
            'grade' => $grade->load('gradeDetails'),
        ]);
    }

    public function getGrades($uploadId)
    {
        $studentId=Student::where('user_id',auth()->id())->value('id');
        $grade = Grade::where('assignment_upload_id', $uploadId)
            ->whereHas('assignmentUpload', function ($query) use ($studentId) {
                $query->where('student_id', $studentId);
            })
            ->with('gradeDetails')
            ->first();

        if (!$grade) {
            return response()->json(['error' => 'Grades not found'], 404);
        }   
        return response()->json([
            'status' => true,
            'grade' => $grade,
        ]);
    }
    

}
