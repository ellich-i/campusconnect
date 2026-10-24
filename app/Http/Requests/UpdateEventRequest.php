<?php

namespace App\Http\Requests;

class UpdateEventRequest extends StoreEventRequest
{
    // Only the organizer or an admin passes (uses EventPolicy::update)
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('event'));
    }

    public function rules(): array
    {
        $joined = $this->route('event')->participants()->count();

        // Same rules as create, but capacity cannot go below current participants
        return array_merge(parent::rules(), [
            'capacity' => ['required', 'integer', 'min:' . max(1, $joined), 'max:500'],
        ]);
    }
}