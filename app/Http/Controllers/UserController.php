<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index ()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email Wajib Diisi',
            'password.required'=>'Password Wajib Diisi',
        ]);
       
        $infoLogin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infoLogin)){
            if(Auth::user()->role =='admin'){
                return redirect('/user/admin');
            } else if(Auth::user()->role =='mahasiswa'){
                return redirect('/user/mahasiswa');
            } else if(Auth::user()->role =='dosen'){
                return redirect('/user/dosen');
            }
        } else {
            return redirect('')->withErrors('Username atau password salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }

}
