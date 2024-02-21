<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TaskController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        
        return view('tasks/index',[
            'categories' => $categories,
            ]);
    
    }
}
