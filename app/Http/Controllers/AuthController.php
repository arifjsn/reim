<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $messages = [
            'required' => 'Kolom :attribute harus diisi'
        ];

        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], $messages);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('reimbursement.index'));
        }

        return back()->withErrors([
            'login' => 'Email atau Password tidak sesuai'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
