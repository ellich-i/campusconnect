<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    // Whitelist: only the name can be mass-assigned
    protected $fillable = ['name'];

    // One location has many events
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}