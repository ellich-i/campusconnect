<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Whitelist: only these columns can be filled through create()/update()
    protected $fillable = ['name', 'description'];

    // One category has many events
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}