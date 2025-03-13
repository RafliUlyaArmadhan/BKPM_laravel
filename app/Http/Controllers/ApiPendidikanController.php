<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Pendidikan; // Pastikan Model Pendidikan diimpor

class ApiPendidikanController extends Controller
{
    public function getAll()
    {
        // Mengambil data terbaru dengan urutan terbaru di atas
        $pendidikan = Pendidikan::orderBy('created_at', 'desc')->get();

        return response()->json($pendidikan, 200);
    }

    public function getPen($id)
    {
        $pendidikan = Pendidikan::find($id);

        return Response::json($pendidikan, 200);
    }

    public function createPen(Request $request)
{
    $pendidikan = Pendidikan::create($request->all());

    // Reload data setelah insert untuk memastikan sinkronisasi
    $pendidikan->refresh();

    // Ambil semua data terbaru
    $pendidikanTerbaru = Pendidikan::latest()->get();

    return response()->json([
        'status' => 'ok',
        'message' => 'Pendidikan berhasil ditambahkan!',
        'data_terbaru' => $pendidikanTerbaru
    ], 201);
}
public function updatePen($id, Request $request)
{
    Pendidikan::find($id)->update($request->all());

    return response()->json([
        'status' => 'ok',
        'message' => 'Pendidikan berhasil dirubah!'
    ], 201);
}

public function deletePen($id)
{
    Pendidikan::destroy($id);

    return response()->json([
        'status' => 'ok',
        'message' => 'Pendidikan berhasil dihapus!'
    ], 201);
}


}