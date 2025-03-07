<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function index($nama = null)
    {
        if ($nama) {
            return $nama; // Langsung menampilkan nama tanpa "Halo,"
        } else {
            abort(403); // Jika tidak ada parameter, tampilkan error 404
        }
    }
}
