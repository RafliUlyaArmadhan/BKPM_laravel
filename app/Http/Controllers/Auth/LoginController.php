<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; // Tambahkan ini
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request) // Pastikan Request sudah di-import
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $login = [
            $loginType => $request->username,
            'password' => $request->password
        ];

        if (auth()->attempt($login)) { // Perbaiki attemp() menjadi attempt()
            return redirect()->route('home');
        }

        return redirect()->route('login')->with(['error' => 'Email/Password salah!']);
    }
}
