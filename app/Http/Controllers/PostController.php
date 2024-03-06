<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Priority;
use App\Http\Requests\PostRequest;
use Auth;

class PostController extends Controller
{
    public function index(Post $post)
   {
    return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
   }
   
    public function completed(Post $post)
   {
    $post->complete();
    return redirect('/');
   }
   
    public function Incomplete(Post $post)
   {
    $post->incomplete();
    return redirect('/');
   }
   
    public function show(Post $post)
   {
    return view('posts.show')->with(['post' => $post]);
       //'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
   }
   
    public function store(PostRequest $request, Post $post)
   {
    $input = $request['post'];
    $input['check'] = 0;
    $input['user_id'] = Auth::id();
    $post->fill($input)->save();
    return redirect('/posts/' . $post->id);
   }

    public function edit(Post $post)
   {
    return view('posts.edit')->with(['post' => $post]);
   }
   
    public function update(PostRequest $request, Post $post)
   {
    $input_post = $request['post'];
    $post->fill($input_post)->save();

    return redirect('/posts/' . $post->id);
   }
   
    public function delete(Post $post)
   {
    $post->delete();
    return redirect('/');
   }
    
    public function create(Category $category,Priority $priority)
   {
    return view('posts.create')->with(['categories' => $category->get(),'priorities' => $priority->get()]);
   }
   
   
   
}
