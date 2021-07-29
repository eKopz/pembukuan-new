<?php

namespace App\Http\Controllers;

use App\model\Anggota;
use App\model\Koperasi;
use App\model\Pengguna;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            $finduser = User::where('google_id', $user->getId())->first();

            if ($finduser) {
                $pengguna = Pengguna::where('id_users', $finduser->id)->first();
                $koperasi = Koperasi::where('id_users', $finduser->id)->first();

                if ($pengguna != null) {
                    $anggota = Anggota::where('id_pengguna', $pengguna->id)->first();

                    if ($anggota != null) {
                        Session::put('token', $finduser->token);
                        Session::put('id', $finduser->id);
                        Session::put('name', $$finduser->name);
                        Session::put('email', $finduser->email);
                        Session::put('role', $$finduser->role);
                        Session::put('id_anggota', $anggota->id);
                        Session::put('foto', $koperasi->foto);
                    }
                    else {
                        Session::put('token', $finduser->token);
                        Session::put('id', $finduser->id);
                        Session::put('name', $finduser->name);
                        Session::put('email', $finduser->email);
                        Session::put('role', $finduser->role);
                        Session::put('foto', $koperasi->foto);
                    }
                }
                else {
                    Session::put('token', $finduser->token);
                    Session::put('id', $finduser->id);
                    Session::put('name', $finduser->name);
                    Session::put('email', $finduser->email);
                    Session::put('role', $finduser->role);
                    Session::put('foto', $koperasi->foto);
                }

                return redirect('/');
            } 
            elseif ($finduser == null) {
                $url = 'https://api.ekopz.id/api/register/koperasi/google';

                $api = Http::post($url, [
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                ]);

                $body = json_decode($api->getBody(), true);

                if ($body['status'] == 201) {
                    return redirect('/');
                } 
                elseif ($body['status'] == 801) {
                    return redirect('/register')->with('alert', 'form tidak boleh kosong');
                }
            }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
