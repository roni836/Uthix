<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $guarded=[];

    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'instructor_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
