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
}
