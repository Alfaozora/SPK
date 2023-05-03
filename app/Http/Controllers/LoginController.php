<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.login');
    }
    public function postlogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:8'
        ], [
            'email.required' => 'Email Harus Diisi!',
            'password.required' => 'Password Harus Diisi!',
            'password.min' => 'Password Minimal 8 Karakter!'
        ]);
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            return redirect('/');
        } else {
            return redirect('login')->withErrors(['Pesan' => 'Email atau Password Salah!']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
