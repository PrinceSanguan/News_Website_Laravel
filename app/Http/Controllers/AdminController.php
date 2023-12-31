<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //

    public function index(Request $req) 
    {
        return view('admin.admin',['page_title'=>'Dashboard']);
    }

    public function posts(Request $req, $type ='')
    {
        switch ($type) {
            case 'add':
                return view('admin.add_post',['page_title'=>'New Posts']);
                break;

            case 'edit':
                return view('admin.posts',['page_title'=>'Edit Posts']);
                break;

            case 'delete':
                return view('admin.posts',['page_title'=>'Delete Posts']);
                break;

            default:
                return view('admin.posts',['page_title'=>'Posts']);
                break;
        }
    }

    public function categories(Request $req) 
    {
        return view('admin.admin',['page_title'=>'Categories']);
    }

    public function users(Request $req) 
    {   
        return view('admin.admin',['page_title'=>'Users']);
    }


}

