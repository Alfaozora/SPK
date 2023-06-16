<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginMobile extends Controller
{
    public function login()
    {
        return view('login.login');
    }
    public function postlogin(Request $request)
    {
        $remember = $request->has('remember') ? true : false;
        if (auth()->attempt(['name' => $request->name, 'password' => $request->password], $remember)) {
            $user = Auth::user();
        } else {
            alert()->error('Email atau Password Salah!', 'Gagal');
            return back();
        }
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|min:8'
        ], [
            'name.required' => 'Username Harus Diisi!',
            'password.required' => 'Password Harus Diisi!',
            'password.min' => 'Password Minimal 8 Karakter!'
        ]);
        $infologin = [
            'name' => $request->name,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            return redirect('/');
        } else {
            return redirect('login')->withErrors(['Pesan' => 'Username atau Password Salah!']);
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
