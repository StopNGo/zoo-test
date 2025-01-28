<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        if ($request->code !== '1234') {
            return redirect()
                ->route('login')
                ->with('error', 'Неправильний код');
        }

        $user = User::firstOrCreate(
            ['phone' => $request->phone]
        );

        if (is_null($user->phone_verified_at)) {
            $user->phone_verified_at = now();
        }

        $user->last_login_at = now();
        $user->save();

        Auth::login($user);

        return redirect()->intended('/');
    }
}