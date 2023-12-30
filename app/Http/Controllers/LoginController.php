<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //

    public function index(Request $req) 
    {
        return view('view');
    }

    public function save(Request $req) 
    {
        $validate = $req->validate([

            'email'=>'required|email',
            'password'=>'required'
        ]);

        if (Auth::attempt($validate, $req->input('remember')))
        {
            //Things go well
            $req->session()->regenerate();

            return redirect()->intended('admin');
        }

       return back()->withErrors([

        'email' => 'Wrong email or password'
       ]);
    }
}


