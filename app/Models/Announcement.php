<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded=[];
    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'announcement_id');
    }
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
