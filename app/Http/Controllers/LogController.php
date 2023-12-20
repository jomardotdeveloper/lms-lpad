<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function adminLogs()
    {
        $title = 'Admin Logs';
        $logs = \App\Models\Log::admin()->get();
        return view('single-pages.logs', compact('logs' , 'title'));
    }

    public function userLogs()
    {
        $title = 'User Logs';
        $logs = \App\Models\Log::userLog()->get();
        return view('single-pages.logs', compact('logs' , 'title'));
    }
}
