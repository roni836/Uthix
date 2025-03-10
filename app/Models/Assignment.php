<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'title', 'description', 'instructor_id', 'classroom_id', 'due_date'
    ];

    public function instructor()
{
    return $this->belongsTo(User::class, 'instructor_id')->select('id', 'name');
}
public function attachments()
    {
        return $this->hasMany(AssignmentAttachment::class, 'assignment_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function uploads()
{
    return $this->hasMany(AssignmentUpload::class, 'assignment_id');
}


}
