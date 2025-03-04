<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SmsVerificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $smsService;

    public function __construct(SmsVerificationService $smsService)
    {
        $this->smsService = $smsService;
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            redirect()->route('home')->send();
            exit;
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $request->validate(['phone' => 'required']);

        if (!$this->smsService->verify($request->phone, $request->code)) {
            return redirect()
                ->route('auth.login')
                ->withErrors(['code' => 'Неправильний код верифікації'])
                ->withInput();
        }

        $user = User::firstOrCreate(['phone' => $request->phone]);
        Auth::login($user);

        return redirect()->route('home');
    }

    public function sendSms(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $request->validate(['phone' => 'required']);

        $code = $this->smsService->sendVerificationCode($request->phone);

        return view('auth.verify', [
            'phone' => $request->phone,
            'mock_code' => $code
        ]);
    }

    public function logout()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        Auth::logout();
        return redirect()->route('home');
    }
}