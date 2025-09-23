<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpDesk extends Model
{
    /** @use HasFactory<\Database\Factories\HelpDeskFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'status',
    ];

    // Relationship: A HelpDesk ticket belongs to a user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
