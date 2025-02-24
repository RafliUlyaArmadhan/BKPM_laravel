<?php

use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\DataController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//ACARA 3
//Route name
Route::get('/', function () {
    return view('welcome');
});

//Basic route
Route::get('/foo', function() {
    return "Hello World";
});

//Parameter route
Route::get('/foo/{id}', function ($id) {
    return 'User ' . $id;
});

//Menentukan parameter route yang diperlukan
Route::get('posts/{post}/comments/{comment}', function ($postID, $commentID) {
    //
});

//File Route Default
Route::get('/user', [UserController::class, 'viewUser'])->name('user');

//Route method POST
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

//Redirect route
Route::redirect('/here', '/there');

//Redirect route with status
Route::redirect('/here301', '/there', 301);
Route::redirect('/here302', '/there', 302);

//Route view
Route::view('/wwelcome', 'welcome');
Route::view('/welcome', 'welcome', ['name' => 'Rafli Ulya']);

//Parameter opsional
Route::get('user/{name?}', function ($name = 'Armadhan') {
    return $name;
});

//Regular Expression Constraint
Route::get('user/{name}', function ($name) {
})->where('name', '[A-Za-z]+');

Route::get('user/{id}', function ($id) {
})->where('id', '[0-9]+');

//Generate URL ke Route Bersama
Route::get('/profile', [UserController::class, 'showProfile'])->name('profileku');

//Middleware
Route::middleware(['check.user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboardLog'])->name('Dashboard');
});

//Namespaces
Route::group(['namespace' => 'App\Http\Controllers\User'], function () {
    Route::get('/user/info', [UserController::class, 'info'])->name('user.info');
    Route::get('/user/data', [DataController::class, 'data'])->name('user.data');
});

//Subdomain Routing
Route::domain('{account}.example.com')->group(function () {
    Route::get('/', function ($account) {
        return "Ini adalah halaman akun: " . $account;
    });
});

//Prefix
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return "Halaman dashboard admin.";
    });
});

//Resource Controller
Route::resource('user', ManagementUserController::class);


   