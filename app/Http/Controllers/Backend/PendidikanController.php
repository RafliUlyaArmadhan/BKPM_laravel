<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendidikanController extends Controller
{
    /**
     * Menampilkan daftar pendidikan.
     */
    public function index()
    {
        $pendidikan = DB::table('pendidikan')->get();
        return view('backend.pendidikan.index', compact('pendidikan'));
    }

    /**
     * Menampilkan form tambah pendidikan.
     */
    public function create()
    {
        return view('backend.pendidikan.create');
    }

    /**
     * Menyimpan data pendidikan ke dalam database.
     */
    public function store(Request $request)
    {

        DB::table('pendidikan')->insert([
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar
        ]);

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit pendidikan.
     */
    public function edit($id)
    {
        $pendidikan = DB::table('pendidikan')->where('id', $id)->first();
        return view('backend.pendidikan.edit', compact('pendidikan'));
    }

    /**
     * Mengupdate data pendidikan.
     */
    public function update(Request $request, $id)
    {
        DB::table('pendidikan')->where('id', $id)->update([
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
            'tahun_masuk' => $request->tahun_masuk,
            'tahun_keluar' => $request->tahun_keluar
        ]);

        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan berhasil diperbarui!');
    }

    /**
     * Menghapus data pendidikan dengan konfirmasi.
     */
    public function destroy($id)
    {
        DB::table('pendidikan')->where('id', $id)->delete();
        return redirect()->route('pendidikan.index')->with('success', 'Data pendidikan berhasil dihapus!');
    }
}