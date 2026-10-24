<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    // organizer_id and status are NOT fillable: the server sets them, not the form
    protected $fillable = [
        'category_id',
        'location_id',
        'title',
        'description',
        'event_date',
        'start_time',
        'end_time',
        'capacity',
    ];

    protected function casts(): array
    {
        return ['event_date' => 'date'];
    }

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    // Many-to-many through the event_participants pivot table
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_participants')
            ->withPivot('joined_at');
    }

    // Derived value: computed, never stored (the normalization decision)
    public function availableSlots(): int
    {
        $taken = $this->participants_count ?? $this->participants()->count();

        return max(0, $this->capacity - $taken);
    }
}
