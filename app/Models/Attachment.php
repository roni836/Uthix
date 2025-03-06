<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $guarded=[];
    public function announcement()
    {
        return $this->belongsTo(Announcement::class, 'announcement_id');
    }
}
