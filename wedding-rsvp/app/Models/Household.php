<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Household extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'token'];

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    public function songRequests(): HasMany
    {
        return $this->hasMany(SongRequest::class);
    }
}
