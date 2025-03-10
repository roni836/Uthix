<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentUpload extends Model
{
    protected $guarded = [];
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id')->select('id', 'name');
    }
    
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }

    public function attachments()
{
    return $this->hasMany(AssignmentAttachment::class, 'assignment_upload_id');
}

    
}
