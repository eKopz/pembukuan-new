<?php

namespace App\Http\Controllers;

use App\model\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();

        return view('pengaturan.karyawan.index', compact('karyawan'));
    }

    public function formTambah()
    {
        return view('pengaturan.karyawan.tambah');
    }

    public function formEdit($id)
    {
        $karyawan = Karyawan::find($id);

        return view('pengaturan.karyawan.edit', compact('karyawan'));
    }

    public function add(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !'
        ];

        $this->validate($request, [
            'karyawan' => 'required'
        ],$message);

        Karyawan::create([
            'karyawan' => $request->karyawan
        ]);

        return redirect('/karyawan')->with('alert-success', 'berhasil tambah data');
    }

    public function update(Request $request, $id)  
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !'
        ];

        $this->validate($request, [
            'karyawan' => 'required'
        ],$message);

        $karyawan = Karyawan::find($id);

        $karyawan->karyawan = $request->karyawan;

        $karyawan->save();

        return redirect('/karyawan')->with('alert-success', 'berhasil update data !');
    }

    public function delete($id)
    {
        $karyawan = Karyawan::find($id);

        $karyawan->delete();

        return redirect('/karyawan')->with('alert-success', 'berhasil hapus data !');
    }
}
