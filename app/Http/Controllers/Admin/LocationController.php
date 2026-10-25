<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::withCount('events')
            ->orderBy('name')
            ->get();

        return view('admin.locations.index', compact('locations'));
    }

    public function store(LocationRequest $request)
    {
        Location::create($request->validated());

        return redirect()
            ->route('admin.locations.index')
            ->with('status', 'Location added successfully.');
    }

    public function edit(Location $location)
    {
        return view('admin.locations.edit', compact('location'));
    }

    public function update(LocationRequest $request, Location $location)
    {
        $location->update($request->validated());

        return redirect()
            ->route('admin.locations.index')
            ->with('status', 'Location updated successfully.');
    }

    public function destroy(Location $location)
    {
        if ($location->events()->exists()) {
            return back()->withErrors([
                'delete' => 'Cannot delete this location because it still has events.',
            ]);
        }

        $location->delete();

        return redirect()
            ->route('admin.locations.index')
            ->with('status', 'Location deleted successfully.');
    }
}