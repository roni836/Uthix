<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\GradeDetail;
use App\Models\Instructor;
use App\Models\AssignmentUpload; // ✅ Add this if missing
use App\Models\Announcement;      // ✅ Needed for instructor check

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function storeGrades(Request $request, $uploadId)
    {
        $instructorId = Instructor::where('user_id', auth()->id())->value('id');
    
        if (!$instructorId) {
            return response()->json(['error' => 'Instructor not found!'], 403);
        }
    
        $assignmentUpload = AssignmentUpload::find($uploadId);
        if (!$assignmentUpload) {
            return response()->json(['error' => 'Assignment upload not found!'], 404);
        }
    
        $announcementInstructorId = Announcement::where('id', $assignmentUpload->announcement_id)
            ->value('instructor_id');
    
        if ($announcementInstructorId !== $instructorId) {
            return response()->json([
                'error' => 'You are not authorized to grade this assignment!'
            ], 403);
        }
    
        $data = $request->json()->all();
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
    
        // Check if a grade already exists for this assignment and instructor
        $grade = Grade::where('assignment_upload_id', $uploadId)
            ->where('instructor_id', $instructorId)
            ->first();
    
        if ($grade) {
            // Update the existing grade
            $grade->update([
                'feedback_note' => $data['feedback_note'] ?? null,
            ]);
    
            // Remove old grade details before inserting new ones
            GradeDetail::where('grade_id', $grade->id)->delete();
        } else {
            // Create a new grade entry
            $grade = Grade::create([
                'assignment_upload_id' => $uploadId,
                'instructor_id' => $instructorId,
                'feedback_note' => $data['feedback_note'] ?? null,
            ]);
        }
    
        // Insert new grade details
        foreach ($data['grades'] as $detail) {
            GradeDetail::create([
                'grade_id' => $grade->id,
                'criterion' => $detail['criterion'],
                'grade' => $detail['grade'],
            ]);
        }
    
        return response()->json([
            'status' => true,
            'message' => $grade->wasRecentlyCreated ? 'Grading submitted successfully!' : 'Grading updated successfully!',
            'grade' => $grade->load('gradeDetails'),
        ], 201);
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
