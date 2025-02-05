<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messages()
    {
        if (!Auth::check()) {
            return view('index');
        }

        $messages = Message::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }

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
        if (!Auth::check()) {
            return redirect()->route('home');
        }

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
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        if ($message->user_id !== auth()->id()) {
            abort(403);
        }

        $message->delete();
        return redirect()->route('home');
    }
}
