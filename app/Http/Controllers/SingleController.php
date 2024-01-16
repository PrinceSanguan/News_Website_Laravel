<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleController extends Controller
{
    //

    public function index(Request $req) 
    {

        $query = "select * from categories order by id desc";
        $categories = DB::select($query);

        $data['categories'] = $categories;
        return view('single', $data);
    }

    public function save(Request $req) 
    {
        $validate = $req->validate([
            'key'=>'required|string',
            'key'=>'required|image'
        ]);
        return view('single');
    }
}

