<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function index(Category $category)
    {
    $categories = Category::all();
    $posts = $category->getByCategory(); // カテゴリーに紐づく投稿を取得

    return view('categories.index', compact('categories', 'posts'));
    }
    
    public function create()
    {
    return view('categories.create');
    }
    
    public function show(Category $category)
    {
    $posts = $category->posts()->paginate(10); // 10は1ページに表示するアイテム数

    return view('categories.show', compact('category', 'posts'));
    }
    
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required',
    ]);

    // 新しいカテゴリーの場合
    $newCategory = Category::create([
        'name' => $request->input('name'),
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }
}
