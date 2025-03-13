<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Pendidikan; // Pastikan Model Pendidikan diimpor

class ApiPendidikanController extends Controller
{
    public function getAll()
    {
        $pendidikan = Pendidikan::all();

        // Mengembalikan data dalam format JSON dengan status 200
        return response()->json($pendidikan, 200);
    }
}
