<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Acara 3

Route::get('/', function () {
    return view('welcome'); // Pastikan 'welcome.blade.php' ada di resources/views/
});

Route::get('/foo', function () {
    return 'Hello, world!';
});

Route::get('/foo/{id}', function ($id) {
    return 'User = ' . $id;
});

Route::get('/user', [UserController::class, 'index']);

Route::redirect('/coba', '/sini');

Route::get('/profile', function () {
    return view('profile', [
        'nama'  => 'Rafli Ulya Armadhan',
        'nim'   => 'E41231493',
        'prodi' => 'Teknik Informatika'
    ]);
});

Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Hello, $name!";
})->where('name', '[A-Za-z]+');

Route::get('/user/id/{id}', function ($id) {
    return "User ID: $id";
})->where('id', '[0-9]+');

Route::get('/user/details/{id}/{name}', function ($id, $name) {
    return "User ID: $id, Name: $name";
})->where(['id' => '[0-9]+', 'name' => '[A-Za-z]+']);

Route::get('/search/{query}', function ($query) {
    return "Search result for: $query";
})->where('query', '.*');

Route::get('/user/profile', [UserController::class, 'show'])->name('profile.user');

Route::get('/user5/profile', function () {
    return "Ini adalah halaman user 5.";
})->name('profile.user5');

Route::get('/user6/profile', [UserController::class, 'show'])->name('profile.user6');

// Acara 4
//generate route ke route bersama
// Route::get('/user/{id}/profile', function ($id) {
//     return view('profile', ['id' => $id]);
// })->name('profile');

Route::get('/redirect-profile', function () {
    return redirect()->route('profile', ['id' => 1, 'photos' => 'yes']);
});

//memeriksa rute saat ini
// Route::get('/user/{id}/profile', function ($id) {
//     return view('profile', ['id' => $id]);
// })->name('profile')->middleware('check.profile');

Route::get('/user/{id}/profile', function ($id) {
    return view('profile', ['id' => $id]);
})->name('profile');

// Middleware (Pastikan first & second ada di Kernel.php)
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/user/profile', function () {
        return "Ini halaman profil user dengan middleware";
    });
});

// Subdomain routing
Route::domain('{account}.myapp.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        return "Account: $account, User ID: $id";
    });
});

// Route prefixes
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        return "Admin Users Page";
    })->name('admin.users');
});

// Tambahan: Route untuk update profile menggunakan GET atau POST
Route::match(['get', 'post'], '/user/{id}/profile/update', [ProfileController::class, 'update'])->name('profile.update');
