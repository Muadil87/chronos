<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimerController extends Controller
{
    // 1. The Session Selection Page (Choose 1h, 2h, 3h)
    public function index()
    {
        return view('timer.index');
    }

    // 2. The Active Timer Page (The actual countdown)
    public function show(Request $request)
    {
        // Get minutes from the URL (default to 25 if missing)
        $minutes = $request->query('minutes', 25); 
        $mode = $request->query('mode', 'Focus');
        
        return view('timer.active', compact('minutes', 'mode'));
    }
}