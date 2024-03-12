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
    $completedTasks = $post->where('check', 1)->latest()->get();
    $incompleteTasks = $post->where('check', 0)->latest()->get();

    $sortedTasks = $incompleteTasks->concat($completedTasks);

    return view('posts.index')->with(['posts' => $sortedTasks]);
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
    $request->validate([
        'post.title' => 'required|string|max:50',
        'post.new_category' => 'nullable|string|max:200',
        'post.category_id' => 'nullable',
        'post.priority_id' => 'nullable',
        'post.body' => 'nullable|string',
        'post.deadline' => 'nullable|date',
    ]);

    $input = $request->input('post');

    // 新しいカテゴリーの場合
    if ($request->has('post.new_category') && $input['new_category'] !=null) {
       $newCategory = Category::create([
            'name' => $input['new_category'], 
            'user_id' => auth()->id(),
        ]);

        // 新しいカテゴリーの ID を取得
        $categoryId = $newCategory->id;
        // 新しいカテゴリーの名前を補完
        $input['name'] = $input['new_category'];
        
        
    } else {
        // 既存のカテゴリーの場合
        $categoryId = $input['category_id'];
    }

    $input['check'] = 0;
    $input['user_id'] = Auth::id();
    $input['category_id'] = $categoryId;
    
    $input['priority_id'] = $request->input('post.priority_id');

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
