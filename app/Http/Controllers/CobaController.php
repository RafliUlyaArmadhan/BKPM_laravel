<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function index($nama = null)
    {
        if ($nama) {
            return $nama; 
        } else {
            abort(403); 
        }
    }
}
