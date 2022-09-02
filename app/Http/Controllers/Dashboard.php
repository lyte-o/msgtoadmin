<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks();
        $recents = auth()->user()->tasks()->latest()->limit(5)->get();


        $task_count = $tasks->groupBy('status')
        ->selectRaw('count(*) as total, status')
        ->get();;

        $count = [];
        $task_count->each(function ($value) use (&$count) {
            $key = str($value->status)->slug('_')->toString();
            $count[$key] = $value->total;
        });

        return view('pages.dashboard', compact('recents', 'count'));
    }

    public function contactAdmin()
    {
        $messages = auth()->user()->messages()->latest()->paginate(self::PG_NUM);

        return view('pages.contact-admin', compact('messages'));
    }
}
