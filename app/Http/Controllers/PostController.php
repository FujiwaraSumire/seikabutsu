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
    public function index(Request $request,Post $post)
   {
    $sort = $request->get('sort');
    if ($sort) {
        if ($sort === '1') {
            $posts = Post::orderBy('deadline')->get();
        } elseif ($sort === '2') {
              $posts = Post::orderBy('deadline', 'DESC')->get();
        } elseif ($sort === '3') {
              $posts = Post::orderBy('category_id')->get();
        } elseif ($sort === '4') {
              $posts = Post::orderBy('category_id', 'DESC')->get();
        }
        
    } else {
        $posts = Post::all();
    }
    
    // $completedTasks = $post->where('check', 1)->latest()->get();
    // $incompleteTasks = $post->where('check', 0)->latest()->get();

    // $sortedTasks = $incompleteTasks->concat($completedTasks);
    
    // ページネーションとソートを適用してデータを取得する
    $posts = Post::sortable()->get(); //sortable() を先に宣言
    return view('posts.index',
    ['sort' => $sort])->with('posts', $posts);
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

    public function edit(Post $post,Category $category,Priority $priority)
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
    
    public function create(Category $category,Priority $priority)
   {
    return view('posts.create')->with([
     'categories' => $category->get(),
     'priorities' => $priority->get()]);
   }

    public function showPostsByCategory($categoryId)
   {
        $category = Category::find($categoryId);
        $posts = Post::where('category_id', $categoryId)
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->orderBy('categories.name', 'asc') // カテゴリー名の五十音順に並べ替え
            ->orderBy('posts.priority_id', 'desc') // 優先度の高い順に並べ替え
            ->orderBy('posts.deadline', 'asc') // 期限の近い順に並べ替え
            ->get();
    
        return view('posts.index', compact('category', 'posts'));
   }
}