<?php

namespace App\Http\Middleware;

use App\model\Koperasi;
use App\model\Pengurus;
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

        $koperasi = Koperasi::where('id_users', Session::get('id'))->first();

        if ($koperasi != null) {
            Session::put('id_koperasi', $koperasi->id);
            Session::put('akses', 1);

            if (Session::get('role') == 1) {
                Session::forget('token');
                Session::forget('id');
                Session::forget('name');
                Session::forget('email');
                Session::forget('role');
                Session::forget('akses');
                Session::forget('id_koperasi');
                Session::forget('id_anggota');
    
                return redirect('/login')->with('alert', 'Maaf, akun yang anda masukkan bukan role untuk pengurus koperasi');
            }
    
            if (Session::get('role') == 2) {
                Session::forget('token');
                Session::forget('id');
                Session::forget('name');
                Session::forget('email');
                Session::forget('role');
                Session::forget('akses');
                Session::forget('id_koperasi');
    
                return redirect('/login')->with('alert', 'Maaf, akun yang anda masukkan bukan role untuk pengurus koperasi');
            }
    
            if (Session::get('role') == 3) {
                return $next($request);
            }
        }
        else {
            $pengurus = Pengurus::where('id_anggota', Session::get('id_anggota'))->first();

            if ($pengurus != null) {
                Session::put('id_koperasi', $pengurus->id_koperasi);

                if ($pengurus->jabatan == 'Ketua' || $pengurus->jabatan == 'Bendahara' || $pengurus->jabatan == 'Administrasi 1' || $pengurus->jabatan == 'Administrasi 2') {
                    Session::put('akses', 1);

                    if (Session::get('role') == 1) {
                        return $next($request);
                    }
                }
        
                if ($pengurus->jabatan == 'Pengawas 1' || $pengurus->jabatan == 'Pengawas 2'){
                    Session::put('akses', 2);

                    if (Session::get('role') == 1) {
                        return $next($request);
                    }
                }
                
                if (Session::get('role') == 1) {
                    Session::forget('token');
                    Session::forget('id');
                    Session::forget('name');
                    Session::forget('email');
                    Session::forget('role');
                    Session::forget('akses');
                    Session::forget('id_koperasi');
                    Session::forget('id_anggota');
        
                    return redirect('/login')->with('alert', 'Maaf, akun yang anda masukkan bukan role untuk pengurus koperasi');
                } 
            }
            else {
                if (Session::get('role') == 1) {
                    Session::forget('token');
                    Session::forget('id');
                    Session::forget('name');
                    Session::forget('email');
                    Session::forget('role');
                    Session::forget('akses');
                    Session::forget('id_koperasi');
                    Session::forget('id_anggota');
        
                    return redirect('/login')->with('alert', 'Maaf, akun yang anda masukkan bukan role untuk pengurus koperasi');
                } 
            }
    
            if (Session::get('role') == 2) {
                Session::forget('token');
                Session::forget('id');
                Session::forget('name');
                Session::forget('email');
                Session::forget('role');
                Session::forget('akses');
                Session::forget('id_koperasi');
                Session::forget('id_anggota');
    
                return redirect('/login')->with('alert', 'Maaf, akun yang anda masukkan bukan role untuk pengurus koperasi');
            }
    
            if (Session::get('role') == 3) {
                return $next($request);
            }
        }
    }
}
