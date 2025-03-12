<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function upload()
    {
        return view('upload');
    }

    public function proses_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // Menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // Ambil ekstensi file
        $extension = strtolower($file->getClientOriginalExtension());

        // Tentukan folder tujuan berdasarkan tipe file
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $destinationPath = public_path('img/dropzone');
        } elseif ($extension === 'pdf') {
            $destinationPath = public_path('pdf/dropzone'); // ✅ Perbaikan lokasi penyimpanan PDF
        } else {
            return back()->with('error', 'Format file tidak didukung.');
        }

        // Pastikan folder ada, jika belum maka buat
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        // Buat nama unik untuk file
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Pindahkan file ke folder yang sesuai
        $file->move($destinationPath, $fileName);

        return back()->with('success', 'File berhasil diunggah!');
    }

    public function dropzone()
    {
        return view('dropzone');
    }

    public function dropzone_store(Request $request)
    {
        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        // Cek apakah file adalah gambar atau PDF
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $destinationPath = public_path('img/dropzone');
        } elseif ($extension === 'pdf') {
            $destinationPath = public_path('pdf/dropzone'); // ✅ Perbaikan lokasi penyimpanan PDF
        } else {
            return response()->json(['error' => 'Format file tidak didukung'], 400);
        }

        // Pastikan folder tujuan ada
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        // Buat nama unik
        $fileName = time() . '.' . $extension;

        // Simpan file
        $file->move($destinationPath, $fileName);

        return response()->json(['success' => $fileName]);
    }

    public function pdf_upload()
    {
        return view('pdf_upload');
    }

    public function pdf_store(Request $request)
    {
        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        // Pastikan hanya menerima PDF
        if ($extension !== 'pdf') {
            return response()->json(['error' => 'Hanya file PDF yang diperbolehkan'], 400);
        }

        $destinationPath = public_path('pdf/dropzone'); // ✅ Perbaikan lokasi penyimpanan PDF

        // Pastikan folder tujuan ada
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true, true);
        }

        // Buat nama unik
        $fileName = 'pdf_' . time() . '.' . $extension;

        // Simpan file
        $file->move($destinationPath, $fileName);

        return response()->json(['success' => $fileName]);
    }
}
