<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nim_or_nidn' => 'required|max:12',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials, $request->filled('remember_token'))) {
            $request->session()->regenerate();

            Alert::success('Login Success')->toToast();

            return redirect()->intended('/');
        }

        Alert::error('Login Failed')->toToast();

        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::success('Logout success')->toToast();

        return redirect('/auth/login');
    }
}
