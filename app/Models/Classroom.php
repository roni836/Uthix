<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = [];

    public function instructor()
    {
        return $this->hasMany(InstructorClassroom::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'classroom_id');
    }
    
}
