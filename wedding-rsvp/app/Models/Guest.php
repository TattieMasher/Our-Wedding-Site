<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['household_id', 'name', 'is_attending', 'special_requests'];

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }
}
