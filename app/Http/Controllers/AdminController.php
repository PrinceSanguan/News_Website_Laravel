<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

class AdminController extends Controller
{
    //

                public function index(Request $req) 
                {
                    return view('admin.admin',['page_title'=>'Dashboard']);
                }

                public function posts(Request $req, $type = '', $id = '')
                {   
                switch ($type) {
                    case 'add':
                    if ($req->isMethod('post')) {

                        $validated = $req->validate([
                            'title' => 'required|string',
                            'file' => 'required|image',
                            'content' => 'required'
                        ]);

                if ($req->hasFile('file') && $req->file('file')->isValid()) {

                    $post = new Post();

                    $path = $req->file('file')->store('/', ['disk' => 'my_disk']);

                    $data = [
                        'title' => $req->input('title'),
                        'category_id' => 1,
                        'image' => $path,
                        'content' => $req->input('content'),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    ];

                    $post->insert($data);
                }
            }

                return view('admin.add_post',['page_title'=>'New Posts']);
                break;

            case 'edit':

                    $post = new Post();
                    $row = $post->find($id);
                    $category = $row->category()->first();

                    return view('admin.edit_posts',['page_title'=>'Edit Posts', 'row' =>$row, 'category' => $category,]);
                    break;

            case 'delete':
                return view('admin.posts',['page_title'=>'Delete Posts']);
                break;

            default:
                
                $query = "select posts.*,categories.category from posts join categories on posts.category_id = categories.id";
                $rows = DB::select($query);
                $data = [
                    'rows' => $rows,
                    'page_title' => 'Posts'
                ];

                return view('admin.posts', $data);
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

