<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image; // Pastikan ini ada

class UploadController extends Controller
{
    public function upload()
    {
        return view('upload');
    }

    public function proses_upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'keterangan' => 'required|string|max:255',
        ]);

        // Simpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // Nama file unik
        $nama_file = time() . '_' . $file->getClientOriginalName();

        // Tentukan lokasi penyimpanan
        $tujuan_upload = public_path('data_file');

        // Jika folder belum ada, buat foldernya
        if (!File::exists($tujuan_upload)) {
            File::makeDirectory($tujuan_upload, 0777, true);
        }

        // Upload file ke folder public/data_file/
        $file->move($tujuan_upload, $nama_file);

        return redirect()->route('upload')->with('success', 'File berhasil diupload!');
    }

    public function resize_upload(Request $request)
    {
        // Validasi input
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'keterangan' => 'required|string|max:255',
        ]);

        // Tentukan lokasi penyimpanan
        $path = public_path('img/logo');

        // Jika folder belum ada, buat foldernya
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        // Ambil file dari form
        $file = $request->file('file');

        // Buat nama file unik
        $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Buat canvas ukuran 200x200
        $canvas = Image::canvas(200, 200);

        // Resize gambar dengan mempertahankan rasio
        $resizeImage = Image::make($file)->resize(null, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Masukkan gambar yang telah diresize ke dalam canvas
        $canvas->insert($resizeImage, 'center');

        // Simpan gambar ke folder public/img/logo/
        if ($canvas->save($path . '/' . $fileName)) {
            return redirect()->route('upload')->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->route('upload')->with('error', 'Data gagal ditambahkan!');
        }
    }
}
