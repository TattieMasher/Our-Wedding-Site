<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SongRequest extends Model
{
    protected $fillable = ['household_id', 'title', 'artist'];

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }
}
