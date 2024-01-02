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
                
                    if ($req->isMethod('post')) {
                        $validated = $req->validate([
                            'title' => 'required|string',
                            'file' => 'image',
                            'content' => 'required'
                        ]);
                
                        $data = [
                            'title' => $req->input('title'),
                            'category_id' => $req->input('category_id'),
                            'content' => $req->input('content'),
                            'updated_at' => now(),
                        ];
                
                        if ($req->hasFile('file') && $req->file('file')->isValid()) {
                            // Remove the old file
                            $oldRow = $post->find($id);
                            if (file_exists('uploads/' . $oldRow->image)) {
                                unlink('uploads/' . $oldRow->image);
                            }
                
                            // Upload the new file
                            $path = $req->file('file')->store('/', ['disk' => 'my_disk']);
                            $data['image'] = $path;
                        }
                
                        $post->where('id', $id)->update($data);
                
                        return redirect('admin/posts/edit/'.$id);
                    }
                
                    $row = $post->find($id);
                    $category = $row->category()->first();
                
                    return view('admin.edit_posts', ['page_title' => 'Edit Posts', 'row' => $row, 'category' => $category]);
                    // Add break statement here if necessary
                    break;
        
            case 'delete':
            return view('admin.posts', ['page_title' => 'Delete Posts']);
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

