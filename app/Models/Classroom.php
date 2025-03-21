<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = [];

    // public function subject()
    // {
    //     return $this->belongsTo(Subject::class, 'subject_id');
    // }
    //  public function chapters()
    // {
    //     return $this->belongsTo(Chapter::class, 'chapter_id');
    // }

    // public function instructor()
    // {
    //     return $this->belongsTo(Instructor::class);
    // }
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id')->select('id', 'name');;
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
