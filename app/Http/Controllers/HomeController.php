<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Image;

class HomeController extends Controller
{
    //

    public function index(Request $req) 
    {
        $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id";
                
        $img = new Image();

        $rows = DB::select($query);

        foreach ($rows as $key => $row) {
            $rows[$key]->image = $img->get_thumb_post('uploads/'.$row->image);
        }

        $query = "select * from categories order by id desc";
        $categories = DB::select($query);

        $data = [
            'rows' => $rows,
            'categories' => $categories,
            'page_title' => 'Home'
        ];
        return view('index', $data);
    }

    public function save(Request $req) 
    {
        $validate = $req->validate([

            'key'=>'required|string',
            'key'=>'required|image'
        ]);

        return view('index');
    }
}

