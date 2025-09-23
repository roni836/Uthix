<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded=[];
   
    public function attachments()
{
    return $this->hasMany(AssignmentAttachment::class, 'announcement_id');
}

    // public function instructor()
    // {
    //     return $this->belongsTo(Instructor::class);
    // }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    } 
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    
    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }
   
    
      
        public function uploads()
    {
        return $this->hasMany(AssignmentUpload::class, 'announcement_id');
    }
}

