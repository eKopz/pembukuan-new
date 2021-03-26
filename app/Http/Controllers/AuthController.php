<?php

namespace App\Http\Controllers;

use App\model\Koperasi;
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
            'password' => $request->password
        ]);

        $body = json_decode($api->getBody(), true);

        if ($body['status'] == 201) {
            Koperasi::create([
                'nama' => $request->name,
                'id_users' => $body['data']['user']['id']
            ]);

            return redirect('/login')->with('alert-success', 'register berhasil, silahkan login terlebih dahulu !');
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

        if ($body['status'] == 200) {
            Session::put('token', $body['access_token']);
            Session::put('id', $body['account']['id']);
            Session::put('name', $body['account']['name']);
            Session::put('email', $body['account']['email']);
            Session::put('role', $body['account']['role']);
            Session::put('id_koperasi', $body['id_koperasi']);

            return redirect('/');
        } 
        else {
            return redirect('/login')->with('alert', 'email atau password salah !');
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
        Session::forget('id_koperasi');

        return redirect('/login')->with('alert-success', 'berhasil logout');
    }
}
