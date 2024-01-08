<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

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
                return redirect('admin/posts');
            }

                return view('admin.add_post',['page_title'=>'New Posts']);
                break;

                case 'edit':
                    $post = new Post();
                    $row = $post->find($id);
                    $category = $row->category();

                    return view('admin.edit_posts',[
                        'page_title'=>'Edit Post',
                        'row'=>$row,
                        'category'=>$category,
                    ]);
                    break;
        
                    case 'delete':
                        $post = new Post();
                        $row = $post->find($id);
                        $category = $row->category()->first();
                    
                        if ($req->isMethod('post')) {
                            // Get the image path
                            $imagePath = 'uploads/' . $row->image;
                    
                            // Delete the image file
                            if (file_exists($imagePath)) {
                                unlink($imagePath);
                            }
                    
                            // Delete the post
                            $post->where('id', $id)->delete();
                    
                            return redirect('admin/posts');
                        }
                    
                
                return view('admin.delete_post', ['page_title' => 'Delete Post', 'row' => $row, 'category' => $category]);
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

    public function categories(Request $req, $type = '', $id ='') 
    {
        switch ($type) {
            case 'add':
            if ($req->isMethod('post')) {

                $validated = $req->validate([
                    'category' => 'required|string',
                ]);

            $category = new Category();

            $data = [
                'category' => $req->input('category'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];

            $category->insert($data);

            return redirect('admin/categories');
    }

        return view('admin.add_category',['page_title'=>'New Category']);
        break;

        case 'edit':
            $category = new Category();
        
            if ($req->isMethod('post')) {
                $validated = $req->validate([
                    'category' => 'required|string',
                ]);
        
                $data = [
                    'category' => $req->input('category'),
                    'updated_at' => now(),
                ];
        
                $category->where('id', $id)->update($data);
        
                return redirect('admin/categories/edit/' . $id);
            }
        
            $row = $category->find($id);
        
            return view('admin.edit_category', ['page_title' => 'Edit Category', 'row' => $row,]);
            // Add break statement here if necessary
            break;

            case 'delete':
                $category = new Category();
                $row = $category->find($id);
 
               // Delete the Category
             $category->where('id', $id)->delete();
            
            return redirect('admin/categories');
        
        return view('admin.delete_category', ['page_title' => 'Delete Category', 'row' => $row,]);
        break;
        default:
        
        $query = "select * from categories order by id desc";

        $rows = DB::select($query);
        $data = [
            'rows' => $rows,
            'page_title' => 'Categories'
        ];

        return view('admin.categories', $data);
        break;
        }
    }

    public function users(Request $req, $type = '', $id = '') 
    {   
            switch ($type) {

            case 'edit':
                $user = new User();
            
                if ($req->isMethod('post')) {
                    $validated = $req->validate([
                        'name' => 'required|string',
                        'email' => 'required|email',
                    ]);
            
                    $data = [
                        'name' => $req->input('name'),
                        'email' => $req->input('email'),
                        'updated_at' => now(),
                    ];

                    if(!empty($req->input('password'))) {
                        $data['password'] = $req->input('password');
                    }
            
                    $user->where('id', $id)->update($data);
            
                    return redirect('admin/users/' . $id);
                }
            
                $row = $user->find($id);
            
                return view('admin.edit_user', ['page_title' => 'Edit User', 'row' => $row,]);
                // Add break statement here if necessary
                break;
    
                case 'delete':
                    $user = new User();
                    $row = $user->find($id);
     
                    if ($req->isMethod('post')) {

                        if($row->id != 1) {

                    // Delete the post
                    $user->where('id', $id)->delete();

                    }

                        
                
                        return redirect('admin/users');
                    }
            
            return view('admin.delete_user', ['page_title' => 'Delete Category', 'row' => $row,]);
            break;
            default:
            
            $query = "select * from users order by id desc";
    
            $rows = DB::select($query);
            $data = [
                'rows' => $rows,
                'page_title' => 'Users'
            ];
    
            return view('admin.users', $data);
            break;
            }

    }


}

