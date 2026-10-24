<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Student dashboard: events I created and events I joined
    public function index(Request $request)
    {
        $user = $request->user();

        return view('dashboard', [
            'created' => $user->organizedEvents()->withCount('participants')->orderBy('event_date')->get(),
            'joined' => $user->joinedEvents()->with(['location', 'category'])->orderBy('event_date')->get(),
        ]);
    }
}