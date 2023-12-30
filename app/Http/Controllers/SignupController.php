<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignupController extends Controller
{
    //

    public function index(Request $req) 
    {
        return view('auth.login');
    }

    public function save(Request $req) 
    {
        $validate = $req->validate([

            'name'=>'required|alpha',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);

        $date = date("Y-m-d H:i:s");
        $user = User::create([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('password')),
            'created_at' => $date,
            'updated_at' => $date
        ]);

        return redirect('login');
    }
}

