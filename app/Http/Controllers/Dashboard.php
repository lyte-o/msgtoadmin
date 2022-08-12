<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $messages = auth()->user()->messages;

        return view('pages.dashboard', compact('messages'));
    }
}
