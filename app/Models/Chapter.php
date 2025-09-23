<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $guarded = [];
    public function instructorClassroom()
    {
        return $this->belongsTo(InstructorClassroom::class, 'instructor_classroom_id');
    }
    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'chapter_id');
    }
}
