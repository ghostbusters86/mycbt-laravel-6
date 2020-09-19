<?php

namespace App\Http\Controllers\AuthAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    public function __construct() {
        $this->middleware('guest:admin')->except(['logout', 'logoutAdmin']);
    }

    public function loginForm() {
        return view('auth-admin.login');
    }

    public function loginSubmit(Request $request) {
        // Validasi form email dan password
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:6'
        ]);

        // menyimpan email dan password kedalam variable
        $credentials = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        // mengecek apakah email dan password terdaftar
        if (Auth::guard('admin')->attempt($credentials, $request->member)) {
            return redirect()->intended(route('admin.index'));
        } else {
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function logoutAdmin() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
