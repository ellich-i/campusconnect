<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest
{
    // The routes are already behind the "auth" and "admin" middleware
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $location = $this->route('location');

        return [
            // unique, but ignore this same row when editing
            'name' => ['required', 'string', 'max:150',
                Rule::unique('locations', 'name')->ignore($location?->id)],
            // nullable: the database column is nullable and seeded rows have no description
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}