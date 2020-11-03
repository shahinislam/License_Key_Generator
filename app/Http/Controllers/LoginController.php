<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'number' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('number', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect('dashboard');
        }

        return redirect('login')->with('status', 'Mobile Number or Password was wrong');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
