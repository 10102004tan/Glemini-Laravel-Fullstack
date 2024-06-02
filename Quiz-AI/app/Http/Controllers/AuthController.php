<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view("auths.login");
    }


    public function showRegister()
    {
        return view("auths.register");
    }

    public function showVerify()
    {
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
            Auth::guard('web')->login($user);
            return redirect()->intended('/dashboard');
        }

        // Đăng nhập thất bại
        return redirect()->back()->withErrors([
            'email|password' => 'Thông tin đăng nhập không chính xác.',
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
            Mail::to($user->email)->send(new VerifyEmail($user));

            return redirect()->route('verification.notice');
        }

        return redirect()->back()->withErrors([
            'name' => 'Please enter your username!',
            'email' => 'Please enter your email!',
            'password' => 'Please enter your password!',
        ])->withInput($request->only('email'));
    }

    // Xử lý yêu cầu xác thực
    public function verify(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'email' => 'required|string',
        ]);
        return redirect()->back()->with('success', 'Email verification sent!');
    }
}
