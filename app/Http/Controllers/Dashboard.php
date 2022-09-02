<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Models\Task;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $recents = auth()->user()->tasks()->latest()->limit(self::LIMIT)->get();

        $count = General::countTask();

        return view('pages.dashboard', compact('recents', 'count'));
    }

    public function contactAdmin()
    {
        $messages = auth()->user()->messages()->latest()->paginate(self::PG_NUM);

        return view('pages.contact-admin', compact('messages'));
    }
}
