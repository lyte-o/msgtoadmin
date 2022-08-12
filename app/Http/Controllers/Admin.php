<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function index()
    {
        $messages = Message::query()->latest()->paginate(self::PG_NUM);

        return view('pages.admin.dashboard', compact('messages'));
    }

    public function manageUsers()
    {
        return view('pages.admin.manage-users');
    }
}
