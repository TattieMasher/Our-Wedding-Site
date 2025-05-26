<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RsvpSubmission extends Model
{
    protected $fillable = [
        'household_id',
        'contact_email',
        'contact_phone',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
    ];
}
