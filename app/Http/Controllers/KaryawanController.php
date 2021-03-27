<?php

namespace App\Http\Controllers;

use App\Imports\KaryawanImport;
use App\model\Karyawan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all()->sortByDesc('id');

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

    public function importData(Request $request)
    {
        $message = [
            'required' => ':attribute tidak boleh kosong !', 
            'mimes:csv,xls,xlsx' => ':attribute hanya boleh diisi oleh format file csv, xls, xlsx !'
        ];

        $this->validate($request, [
            'import_data' => 'required|mimes:csv,xls,xlsx'
        ], $message);

        $file = $request->file('import_data');

        $nama_file = rand()."-karyawan-".$file->getClientOriginalName();

        $file->move('excel', $nama_file);

        Excel::import(new KaryawanImport, public_path('/excel/'. $nama_file));

        return redirect('/karyawan')->with('alert-success', 'berhasil tambah data');
    }
}
