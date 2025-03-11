<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentAttachment extends Model
{
    protected $guarded = [];
    public function assignmentUpload()
    {
        return $this->belongsTo(AssignmentUpload::class, 'assignment_upload_id');
    }
    
}
