<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->orderBy('created_at', 'desc')->get();
        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        Message::create([
            'content' => $request->content,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('home');
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required'
        ]);

        if ($message->user_id !== auth()->id()) {
            abort(403);
        }

        $message->update([
            'content' => $request->content
        ]);

        return redirect()->route('home');
    }

    public function destroy(Message $message)
    {
        if ($message->user_id !== auth()->id()) {
            abort(403);
        }

        $message->delete();
        return redirect()->route('home');
    }
}
