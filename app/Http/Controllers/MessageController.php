<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
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

            return redirect()->route('dashboard')->with('status', 'Your message has been successfully sent to the Admin!');
        }
        catch (\Exception $exception) {
            return back()->with($this->getExceptionMsg($exception));
        }
    }

}
