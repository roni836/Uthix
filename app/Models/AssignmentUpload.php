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
    
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    } 
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function attachments()
{
    return $this->hasMany(AssignmentAttachment::class, 'assignment_upload_id');
}

    
}
