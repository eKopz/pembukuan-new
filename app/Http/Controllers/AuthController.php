<?php

namespace App\Http\Controllers;

use App\model\Anggota;
use App\model\Koperasi;
use App\model\Pengguna;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    //form login
    public function formLogin()
    {
        return view('authentikasi.login');
    }

    //form register
    public function formRegister()
    {
        return view('authentikasi.register');
    }

    //register
    public function register(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong',
            'confirmed' => 'password tidak sama dengan repeat password'
        ];

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ], $message);

        $url = 'https://api.ekopz.id/api/register/koperasi';

        $api = Http::post($url, [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'google_id' => null
        ]);

        $body = json_decode($api->getBody(), true);

        if ($body['status'] == 201) {
            $user = User::where('email', $request->email)->first();

            if ($user->email_verified_at != null) {
                return redirect('/login')->with('alert-success', 'register berhasil, silahkan login terlebih dahulu !'); 
            }
            else {
                return redirect("/email/verifikasi/$request->email");
            }
        } 
        elseif ($body['status'] == 801) {
            return redirect('/register')->with('alert', 'form tidak boleh kosong');
        }
    }

    // login
    public function login(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong'
        ];

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], $message);

        $url = 'https://api.ekopz.id/api/login';

        $api = Http::post($url, [
            'email' => $request->email,
            'password' => $request->password
        ]);

        $body = json_decode($api->getBody(), true);
        
        if($body['status'] == 200){
            $pengguna = Pengguna::where('id_users', $body['account']['id'])->first();
            $koperasi = Koperasi::where('id_users', $body['account']['id'])->first();

            if ($body['account']['email_verified_at'] != null) {
                if ($pengguna != null) {
                    $anggota = Anggota::where('id_pengguna', $pengguna->id)->first();
    
                    $koperasi_by_anggota = Koperasi::find($anggota->id_koperasi);
    
                    if ($anggota != null) {
                        Session::put('token', $body['access_token']);
                        Session::put('id', $body['account']['id']);
                        Session::put('name', $body['account']['name']);
                        Session::put('email', $body['account']['email']);
                        Session::put('role', $body['account']['role']);
                        Session::put('id_anggota', $anggota->id);
                        Session::put('foto', $koperasi_by_anggota->foto);
                        Session::put('nama_koperasi', $koperasi_by_anggota->nama);
                    }
                    else {
                        Session::put('token', $body['access_token']);
                        Session::put('id', $body['account']['id']);
                        Session::put('name', $body['account']['name']);
                        Session::put('email', $body['account']['email']);
                        Session::put('role', $body['account']['role']);
                        Session::put('foto', $koperasi->foto);
                        Session::put('nama_koperasi', $koperasi_by_anggota->nama);
                    }
                }
                else {
                    Session::put('token', $body['access_token']);
                    Session::put('id', $body['account']['id']);
                    Session::put('name', $body['account']['name']);
                    Session::put('email', $body['account']['email']);
                    Session::put('role', $body['account']['role']);
                    Session::put('foto', $koperasi->foto);
                    Session::put('nama_koperasi', $koperasi->nama);
                }
    
                return redirect('/');
            }
            else {
                return redirect("/email/verifikasi/$request->email");
            }

        } else {
            return redirect('/login')->with('alert', 'email atau password salah !');
        }
    }

    public function emailVerifikasi($email_verifikasi)
    {
        $email = $email_verifikasi;

        $user = User::where('email', $email_verifikasi)->first();

        if ($user->email_verified_at != null) {
            return redirect('/login');
        }
        else {
            return view('authentikasi.verifikasi_email', compact('email'));
        }
    }

    //logout
    public function logout()
    {
        Session::forget('token');
        Session::forget('id');
        Session::forget('name');
        Session::forget('email');
        Session::forget('role');
        Session::forget('id_anggota');
        Session::forget('akses');
        Session::forget('foto');
        Session::forget('jabatan');
        Session::forget('nama_koperasi');
        Session::forget('banner');

        return redirect('/login')->with('alert-success', 'berhasil logout');
    }

    public function viewForgotPassword()
    {
        return view('authentikasi.forgot_password');
    }

    public function sendEmailForgotPassword(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong'
        ];

        $this->validate($request, [
            'email' => 'required',
        ], $message);

        $url = 'https://api.ekopz.id/api/password/email';

        $api = Http::post($url, [
            'email' => $request->email
        ]);

        return redirect()->back()->with('alert-success', 'berhasil kirim email');
    }
}
