<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\MessageController;

Route::get('/login', fn() => view('auth.login'))->name('login');

Route::post('/login', function (Request $request) {
    $request->validate(['phone' => 'required']);

    if ($request->input('code') !== '1234') {

        Session::put('phone', $request->phone);
        return redirect()->route('login')
            ->withErrors(['code' => 'Invalid verification code'])
            ->withInput();
    }

    $user = User::firstOrCreate(['phone' => $request->phone]);
    Auth::login($user);

    return redirect()->route('home');
});

Route::post('/send-sms', function (Request $request) {
    $request->validate(['phone' => 'required']);

    // Simulate sending an SMS with code (always "1234" for testing)
    Session::put('phone', $request->phone);
    return view('auth.verify', ['phone' => $request->phone]);
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/', [MessageController::class, 'index'])->name('home');

Route::post('/messages', [MessageController::class, 'store']);
Route::put('/messages/{message}', [MessageController::class, 'update']);
Route::delete('/messages/{message}', [MessageController::class, 'destroy']);

