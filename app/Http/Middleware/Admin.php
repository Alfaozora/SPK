<?php

namespace App\Http\Middleware;

use Alert;
use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role != 1) {
            Alert::error('No Access', 'Anda Harus Login Sebagai Admin Terlebih Dahulu');
            return redirect()->back();
        }
        return $next($request);
    }
}
