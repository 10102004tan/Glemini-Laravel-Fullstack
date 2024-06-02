<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    // public function login(Request $request)
    // {
    //     // Xác thực dữ liệu đầu vào
    //     $request->validate([
    //         'username' => 'required|string',
    //     ]);

    //     $username = $request->input('username');

    //     $user = \App\Models\UserTest::where('username', $username)->first();

    //     if ($user) {
    //         // Đăng nhập thành công, chuyển hướng đến trang trước đó
    //         Auth::guard('usertest')->login($user);
    //         return redirect()->intended('room');
    //     }

    //     // Đăng nhập thất bại
    //     return redirect()->back()->withErrors([
    //         'username' => 'Thông tin đăng nhập không chính xác.',
    //     ])->withInput($request->only('username'));
    // }

    // // Xử lý yêu cầu đăng xuất
    // public function logout()
    // {
    //     Auth::guard('usertest')->logout();
    //     return redirect('/auth/login');
    // }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $saved = $user->save();
        if ($saved) {
            return redirect()->back()->with('success', 'Register success!');
        }

        return redirect()->back()->withErrors([
            'name' => 'Please enter your username!',
            'email' => 'Please enter your email!',
            'password' => 'Please enter your password!',
        ])->withInput($request->only('username'));
    }
}
