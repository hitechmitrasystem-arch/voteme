<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Admin Login Form
    |--------------------------------------------------------------------------
    */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Admin Login
    |--------------------------------------------------------------------------
    */
    public function login(Request $request)
    {
        // Validate request
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt login using admin guard
        if (Auth::guard('admin')->attempt(
            $request->only('email', 'password')
        )) {
            // Regenerate session for security
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        // If login fails
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email');
    }

    /*
    |--------------------------------------------------------------------------
    | Handle Admin Logout
    |--------------------------------------------------------------------------
    */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}