<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){

        return view('login');
    }

    public function authenticate(Request $request){

        Session::flash('email', $request->password);
       $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

<<<<<<< HEAD
            return redirect()->intended('/dashboard');
=======
            return redirect()->intended('/admin/dashboard');
>>>>>>> 01a85b3 (Update 1 july)
        }
        return back()->with('loginError','email atau password salah');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/dashboard');


    }
}
