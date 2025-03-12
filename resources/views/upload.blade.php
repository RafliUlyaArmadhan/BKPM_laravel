<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    /**
     * Menyimpan file yang diunggah oleh Dropzone.
     */
    public function store(Request $request)
    {
        // Validasi file yang diunggah (hanya menerima gambar & PDF dengan ukuran maksimal 2MB)
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
        ]);

        // Ambil file dari request
        $file = $request->file('file');

        // Buat nama unik untuk file (timestamp + nama asli)
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Dapatkan ekstensi file dalam huruf kecil
        $extension = strtolower($file->getClientOriginalExtension());

        // Tentukan folder tujuan berdasarkan jenis file
        $destinationPath = ($extension === 'pdf')
            ? public_path('img/pdf')        // Jika PDF, simpan di public/img/pdf
            : public_path('img/dropzone');  // Jika gambar, simpan di public/img/dropzone

        // Buat folder jika belum ada
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        // Simpan file ke folder yang ditentukan
        $file->move($destinationPath, $fileName);

        // Kembalikan respons JSON ke Dropzone
        return response()->json([
            'success' => true,
            'message' => 'File berhasil diunggah!',
            'file_url' => asset(($extension === 'pdf' ? 'img/pdf/' : 'img/dropzone/') . $fileName),
        ]);
    }
}
