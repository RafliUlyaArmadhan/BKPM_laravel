<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function upload(){
        return view('upload');
    }
    public function proses_upload(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
            'keterangan' => 'required',
        ],[
            'file.required' => 'File gambar wajib diunggah.',
            'file.mimes' => 'Format file harus jpg, jpeg, png, atau gif.',
            'file.max' => 'Ukuran file maksimal 2MB.',
            'keterangan.required' => 'Keterangan wajib diisi.'
        ]);
        //menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
        //nama file
        echo 'File Name: '.$file->getClientOriginalName().'<br>';
        //extensi file
        echo 'File Extension: '.$file->getClientOriginalExtension().'<br>';
        //real path
        echo 'File Real Path: '.$file->getRealPath().'<br>';
        //ukuran file
        echo 'File Size: '.$file->getSize().'<br>';
        //tipe mime
        echo 'File Mime Type: '.$file->getMimeType();
        //isi dengan nama folder tempa kemana file diupload
        $tujuan_upload = 'data_file';
        //upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());
        return back()->with('success', 'File berhasil diupload!');
    }
    // public function resize(){
    //     return view('upload_resize');
    // }

    public function resize_upload(Request $request)
{
    $this->validate($request, [
        'file' => 'required',
        'keterangan' => 'required',
    ]);

    $originalPath = public_path('data_file');
    $resizePath = public_path('img/logo');

    if (!File::isDirectory($originalPath)) {
        File::makeDirectory($originalPath, 0777, true);
    }

    if (!File::isDirectory($resizePath)) {
        File::makeDirectory($resizePath, 0777, true);
    }

    $file = $request->file('file');
    $originalFileName = $file->getClientOriginalName();
    $file->move($originalPath, $originalFileName);

    $originalFilePath = $originalPath . '/' . $originalFileName;
    $resizeFileName = 'logo_' . uniqid() . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);

    $canvas = Image::canvas(200, 200);
    $resizeImage = Image::make($originalFilePath)->resize(null, 200, function ($constraint) {
        $constraint->aspectRatio();
    });
    $canvas->insert($resizeImage, 'center');

    // Save resized image
    $canvas->save($resizePath . '/' . $resizeFileName);

    return redirect(route('upload'))->with('success', 'Data berhasil ditambahkan!');
}
    
    public function dropzone(){
        return view('dropzone');
    }
    public function dropzone_store(Request $request){
        if (!$request->hasFile('file')) {
            return response()->json(['message' => 'Tidak ada file yang terupload!'], 400);
        }

        $uploadedFiles = $request->file('file');
        $savedFiles = [];

        foreach ($uploadedFiles as $image) {
            $imageName = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path('img/dropzone'), $imageName);
            $savedFiles[] = $imageName;
        }

        return response()->json(['success' => $savedFiles]);
    }
    public function pdf_upload(){
        return view('pdf_upload');
    }
    public function pdf_store(Request $request)
        {
            // Pastikan ada file yang diunggah
            if (!$request->hasFile('file')) {
                return response()->json(['error' => 'Tidak ada file yang diunggah'], 400);
            }

            $files = $request->file('file'); // Bisa berupa array atau file tunggal
            $uploadedFiles = [];
            $path = public_path('pdf/dropzone');

            // Cek apakah folder penyimpanan ada, jika tidak buat baru
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Jika banyak file dikirim, proses satu per satu
            if (is_array($files)) {
                foreach ($files as $file) {
                    $pdfName = 'pdf_' . time() . '_' . uniqid() . '.' . $file->extension();
                    $file->move($path, $pdfName);
                    $uploadedFiles[] = $pdfName;
                }
            } else { // Jika hanya satu file
                $pdfName = 'pdf_' . time() . '_' . uniqid() . '.' . $files->extension();
                $files->move($path, $pdfName);
                $uploadedFiles[] = $pdfName;
            }

            return response()->json(['success' => $uploadedFiles]);
        }
}