<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }
        return view("auths.login");
    }

    public function showRegister()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }
        return view("auths.register");
    }

    public function showVerify()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }
        return view("auths.verify");
    }

    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if (Hash::check($request->password, $user->password)) {
            // Kiểm tra xác thực email
            if (!$user->hasVerifiedEmail()) {
                try {
                    Mail::to($user->email)->send(new VerifyEmail($user));
                    return redirect()->route('verification.notice', $user->id);
                } catch (\Exception $e) {
                    Log::error('Email could not be sent: ' . $e->getMessage());
                    return redirect()->back()->withErrors(['email' => 'Email could not be sent. Please try again.']);
                }
            }

            Auth::guard('web')->login($user);
            return redirect()->intended('/dashboard');
        }

        // Đăng nhập thất bại
        return redirect()->back()->withErrors([
            'email|password' => 'Email or password was wrong.',
        ])->withInput($request->only('email')); // Giữ lại email đăng nhập trong form
    }

    // Xử lý yêu cầu đăng xuất
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/auth/login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => Str::random(32),
        ]);

        $saved = $user->save();
        if ($saved) {
            try {
                Mail::to($user->email)->send(new VerifyEmail($user));
                return redirect()->route('verification.notice', $user->id);
            } catch (\Exception $e) {
                Log::error('Email could not be sent: ' . $e->getMessage());
                return redirect()->back()->withErrors(['Error' => 'Email could not be sent. Please try again.']);
            }
        }

        return redirect()->back()->withErrors([
            'name' => 'Please enter your username!',
            'email' => 'Please enter your email!',
            'password' => 'Please enter your password!',
        ])->withInput($request->only('email'));
    }
}
