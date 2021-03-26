<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class RoleKoperasi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::get('token') == null) {
            return redirect('/login')->with('alert', 'login terlebih dahulu');
        }

        if (Session::get('role') == 1) {
            Session::forget('token');
            Session::forget('id');
            Session::forget('name');
            Session::forget('email');
            Session::forget('role');

            return redirect('/login')->with('alert', 'Maaf, akun yang anda masukkan bukan role untuk pengurus koperasi');
        }

        if (Session::get('role') == 2) {
            return redirect('/login')->with('alert', 'Maaf, akun yang anda masukkan bukan role untuk pengurus koperasi');
        }

        if (Session::get('role') == 3) {
            return $next($request);
        }
        
    }
}
