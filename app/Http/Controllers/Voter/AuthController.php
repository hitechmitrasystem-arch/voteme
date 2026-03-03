<?php

namespace App\Http\Controllers\Voter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('voter.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'voter_id' => 'required|string',
            'passcode' => 'required|string',
        ]);

        if (Auth::guard('voter')->attempt([
            'voter_id' => $request->voter_id,
            'password' => $request->passcode,
        ])) {

            $request->session()->regenerate();

            return redirect()->route('voter.dashboard');
        }

        return back()->withErrors([
            'voter_id' => 'Invalid Voter ID or Passcode.',
        ])->onlyInput('voter_id');
    }

    public function logout(Request $request)
    {
        Auth::guard('voter')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('voter.login');
    }
}