<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $guarded = [];
    public function gradeDetails()
    {
        return $this->hasMany(GradeDetail::class, 'grade_id');
    }
    // In App\Models\Grade.php
public function assignmentUpload()
{
    return $this->belongsTo(AssignmentUpload::class, 'assignment_upload_id'); 
}

}
