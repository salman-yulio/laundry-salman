<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                return redirect()->route('a.dashboard');
            } else if (Auth::user()->role == 'kasir') {
                return redirect()->route('k.dashboard');
            } else if (Auth::user()->role == 'owner') {
                return redirect()->route('o.dashboard');
            }
            return redirect()->intended('/dashboard');
        } else {
            // return back()->with('loginError', 'Username atau password salah');
            Session::flash('error', 'Email atau password salah');
            return redirect('/');
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
