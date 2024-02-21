<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;


class PostController extends Controller
{
    public function index(Post $post)
   {
    
    $categories = Category::all();
        
        return view('tasks/index',[
            'categories' => $categories,
            ]);
   }
   
   public function create(Category $category)
    {
    return view('posts.index')->with(['categories' => $category->get()]);
    }
    
    public function showCreateForm(int $id)
    {
    return view('tasks/create', [
        'category_id' => $id
    ]);
    }
}
