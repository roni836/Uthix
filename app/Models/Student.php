<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function instructors()
    {
        return $this->hasMany(InstructorClassroom::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
