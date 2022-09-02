<?php

namespace App\Http\Controllers;

use App\Helpers\General;
use App\Models\Message;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function index()
    {
        $messages = Message::query()->latest()->get();
        $tasks = Task::query()->latest()->limit(self::LIMIT)->get();
        $users = User::query()->where('role', 'user')->latest()->limit(self::LIMIT)->get();

        $count  = [
            'users' => User::query()->where('role', 'user')->count(),
            'tasks' => General::countTask(true)
        ];

        return view('pages.admin.dashboard', compact('messages', 'tasks', 'users', 'count'));
    }

    public function manageUsers(Request $request)
    {
        $users = User::query()->whereNotIn('role', ['admin']);

        if ($request->has('status')) {
            if (!in_array(strtolower($request->status), ['pending', 'active']))
                return redirect()->route('manage-users')->with('error', 'Invalid Status!');

            $users->where('status', $request->status);
        }

        $users = $users->latest()->paginate(self::PG_NUM);

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

    public function tasks()
    {
        $tasks = Task::query()->latest()->get();

        return view('pages.admin.tasks', compact('tasks'));
    }
}
