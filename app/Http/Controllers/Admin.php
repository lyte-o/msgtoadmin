<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
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
        $users = User::query()->latest()->paginate(self::PG_NUM);

        return view('pages.admin.manage-users', compact('users'));
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        try {
            $user = User::query()->where('email', $request->email)->first();

            $user->status = $user->status == 'pending' ? 'active' : 'pending';

            $user->save();

            return back()->with('status', $user->full_name . ' is now ' . strtoupper($user->status));
        }
        catch (\Exception $exception) {
            return back()->with('error', $this->getExceptionMsg($exception));
        }
    }
}
