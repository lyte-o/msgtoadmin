<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks();
        $recents = auth()->user()->tasks()->latest()->limit(5)->get();

        $data = [];

        $data['not_started'] = $tasks->where('status', 'NOT STARTED')->count();
        $data['ongoing'] = $tasks->where('status', 'ONGOING')->count();
        $data['completed'] = $tasks->where('status', 'COMPLETED')->count();

        return view('pages.dashboard', compact('recents', 'data'));
    }

    public function contactAdmin()
    {
        $messages = auth()->user()->messages()->latest()->paginate(self::PG_NUM);

        return view('pages.contact-admin', compact('messages'));
    }
}
