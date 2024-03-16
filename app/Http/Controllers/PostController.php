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

    public function index(Request $request, Post $post)
    {
        // 通常のポストデータも取得
        $posts = $post->all();
        
        // グループ化されたポストを取得する
        $groupedPosts = Post::groupByAttributes();
    
        // ビューにデータを渡して表示する
        return view('posts.index', compact('groupedPosts', 'posts'));
    }

    public function completed(Post $post)
    {
        $post->complete();
        return redirect('/');
    }
   
    public function incomplete(Post $post)
    {
        $post->incomplete();
        return redirect('/');
    }
   
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
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
        if ($request->has('post.new_category') && $input['new_category'] != null) {
            $newCategory = Category::create([
                'name' => $input['new_category'], 
                'user_id' => auth()->id(),
            ]);

            // 新しいカテゴリーの ID を取得
            $categoryId = $newCategory->id;
            // 新しいカテゴリーの名前を補完
            $input['name'] = $input['new_category'];
            $input['category_id'] = $categoryId;
        } else {
            // 既存のカテゴリーの場合
            $categoryId = $input['category_id'];
        }

        $input['check'] = 0;
        $input['user_id'] = Auth::id();
        $input['category_id'] = $categoryId;
        $input['priority_id'] = $request->input('post.priority_id');
        $input['deadline'] = $input['deadline'] ? date('Y-m-d', strtotime($input['deadline'])) : null;

        $post->fill($input)->save();

        return redirect('/');
    }

    public function edit(Post $post, Category $category, Priority $priority)
    {
        return view('posts.edit')->with([
            'post' => $post,
            'categories' => $category->get(),
            'priorities' => $priority->get()
        ]);
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
    
    public function create(Category $category, Priority $priority)
    {
        return view('posts.create')->with([
            'categories' => $category->get(),
            'priorities' => $priority->get()
        ]);
    }

}
