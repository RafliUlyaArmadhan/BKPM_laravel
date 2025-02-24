<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementUserController extends Controller
{
    public function index()
    {
        $nama = "Rafli Ulya Armadadhan";
        $pelajaran = ["Algoritma & Pemrograman", "Kalkulus", "Pemrograman Web"];

        return view('home', compact('nama', 'pelajaran'));
    }
}
