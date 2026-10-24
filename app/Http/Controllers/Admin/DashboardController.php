<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'users' => User::count(),
                'events' => Event::count(),
                'cancelled' => Event::where('status', 'cancelled')->count(),
                'categories' => Category::count(),
            ],
        ]);
    }
}