<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);
        if ($user->hasVerifiedEmail()) {
            return redirect('/auth/login')->with('success', 'Your email has been verified!');
        }

        return view('auths.verify', ['id' => $id]);
    }

    public function verify(EmailVerificationRequest $request)
    {

        $request->fulfill();
        $user = User::find($request->route('id'));

        // Update user email_verification_token
        if (!$user) {
            return redirect('/auth/register')->with('error', 'User not found, register again!');
        }else {
            $user->update(['email_verification_token' => 'verified']);
        }

        return redirect('/auth/login')->with('success', 'Your email has been verified!');
    }

    public function reverify(Request $request)
    {
        $user = User::find($request->route('id'));
        if (!$user) {
            return redirect('/auth/register')->with('error', 'User not found, register again!');
        }

        // Send email verification
        if (!$user->hasVerifiedEmail()) {
            try {
                Mail::to($user->email)->send(new VerifyEmail($user));
                return redirect()->back()->with('success', 'Email verification sent!');
            } catch (\Exception $e) {
                Log::error('Email could not be sent: ' . $e->getMessage());
                return redirect()->back()->withErrors(['email' => 'Email could not be sent. Please try again.']);
            }
        }
    }
}
