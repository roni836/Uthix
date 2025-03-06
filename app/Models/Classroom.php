<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
