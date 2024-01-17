<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SingleController extends Controller
{
    //

    public function index(Request $req, $id = '') 
{
    $query = "select * from posts where slag = :slag limit 1";
    $row = DB::select($query, ['slag' => $id]);

    $data = [];

    if ($row) {
        $postId = $row[0]->id;

        $query = "select * from categories where id = :id limit 1";
        $category = DB::select($query, ['id' => $postId]);

        // Check if the category is found before accessing its index
        if ($category) {
            $data['row'] = $row[0];
            $data['category'] = $category[0];
        }
    }

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

