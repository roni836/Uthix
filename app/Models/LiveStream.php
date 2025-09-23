<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
    protected $guarded = [];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
