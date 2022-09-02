<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = auth()->user()->messages()->latest()->paginate(self::PG_NUM);

        return view('pages.contact-admin', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        try {
            $user = auth()->user();

            $user->messages()->create([
                'body' => $request->message
            ]);

            return redirect()->route('contact-admin')->with('status', 'Your message has been successfully sent to the Admin!');
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }

}
