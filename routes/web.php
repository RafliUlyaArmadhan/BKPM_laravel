<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PendidikanController;
use App\Http\Controllers\Backend\PengalamanKerjaController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\UploadController;

// ACARA 3
// Route name
Route::get('/', function () {
    return view('welcome');
});

// Basic route
Route::get('/foo', function () {
    return "Hello World";
});

// Parameter route
Route::get('/foo/{id}', function ($id) {
    return 'User ' . $id;
});

// Menentukan parameter route yang diperlukan
Route::get('posts/{post}/comments/{comment}', function ($postID, $commentID) {
    //
});

// File Route Default
Route::get('/user', [UserController::class, 'viewUser'])->name('user');

// Route method POST
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

// Redirect route
Route::redirect('/here', '/there');

// Redirect route with status
Route::redirect('/here301', '/there', 301);
Route::redirect('/here302', '/there', 302);

// Route view
Route::view('/wwelcome', 'welcome');
Route::view('/welcome', 'welcome', ['name' => 'Rafli Ulya']);

// Parameter opsional
Route::get('user/{name?}', function ($name = 'Armadhan') {
    return $name;
});

// Regular Expression Constraint
Route::get('user/{name}', function ($name) {
})->where('name', '[A-Za-z]+');

Route::get('user/{id}', function ($id) {
})->where('id', '[0-9]+');

// Generate URL ke Route Bersama
Route::get('/profile', [UserController::class, 'showProfile'])->name('profileku');

// Middleware
Route::middleware(['check.user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboardLog'])->name('Dashboard');
});

// Namespaces
Route::group(['namespace' => 'App\Http\Controllers\User'], function () {
    Route::get('/user/info', [UserController::class, 'info'])->name('user.info');
    Route::get('/user/data', [DataController::class, 'data'])->name('user.data');
});

// Subdomain Routing
Route::domain('{account}.example.com')->group(function () {
    Route::get('/', function ($account) {
        return "Ini adalah halaman akun: " . $account;
    });
});

// Prefix
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Halaman dashboard admin.";
    });
});

// ACARA 5
// Resource Controller
Route::resource('user', ManagementUserController::class);

// ACARA 6
Route::get('/home', function () {
    return view('home');
});

Route::get('/user', [ManagementUserController::class, 'index']);

// ACARA 7
Route::group(['namespace' => 'App\Http\Controllers\frontend'], function () {
    Route::resource('homes', 'HomeController');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ACARA 8
Route::resource('dashboard', DashboardController::class);
Route::resource('pendidikan', PendidikanController::class);
Route::resource('pengalaman_kerja', PengalamanKerjaController::class);

// 
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dash.index');
//
Route::get('/session/create', [SessionController::class, 'create']);
Route::get('/session/show', [SessionController::class, 'show']);
Route::get('/session/delete', [SessionController::class, 'delete']);

Route::get('/pegawai/{pli}', [PegawaiController::class, 'index']);
Route::get('/formulir', [PegawaiController::class, 'formulir']);
Route::post('/formulir/proses', [PegawaiController::class, 'proses']);

Route::get('/cobaeror', [CobaController::class, 'index']);
Route::get('/cobaeror/{nama?}', [CobaController::class, 'index']);

Route::get('/upload', [UploadController::class, 'upload'])->name('upload');
Route::post('/upload/proses', [UploadController::class, 'proses_upload'])->name('upload.proses');
Route::post('/upload/resize', [UploadController::class, 'resize_upload'])->name('upload.resize');


Route::get('/dropzone', [UploadController::class, 'dropzone'])->name('dropzone');
Route::post('/dropzone/store', [UploadController::class, 'dropzone_store'])->name('dropzone.store');
Route::get('/pdf_upload', [UploadController::class, 'pdf_upload'])->name('pdf.upload');
Route::post('/pdf/store', [UploadController::class, 'pdf_store'])->name('pdf.store');
Route::post('/dropzone/delete', [UploadController::class, 'deletePdfFile'])->name('dropzone.delete');