<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PostController::class, 'index']);

/* index page */
Route::get("/posts/{id}/tasks",[PostController::class,"index"])->name("posts.index");

/* tasks new create page */
Route::get('/posts/{id}/tasks/create', [PostController::class,"showCreateForm"])->name('posts.create');
Route::post('/posts/{id}/tasks/create', [PostController::class,"create"]);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/posts', [PostController::class, 'index']);
require __DIR__.'/auth.php';
