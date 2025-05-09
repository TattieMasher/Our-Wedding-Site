<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftContribution extends Model
{
    protected $fillable = [
        'name',
        'email',
        'message',
        'items',
        'amount',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
