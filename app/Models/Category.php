<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Whitelist: only these columns can be filled through create()/update()
    protected $fillable = ['name', 'description'];
}
