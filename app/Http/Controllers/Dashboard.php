<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $messages = auth()->user()->messages()->latest()->paginate(self::PG_NUM);

        return view('pages.dashboard', compact('messages'));
    }

    public function contactAdmin()
    {
        $messages = auth()->user()->messages()->latest()->paginate(self::PG_NUM);

        return view('pages.contact-admin', compact('messages'));
    }
}
