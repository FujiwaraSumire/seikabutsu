<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    
    // Postに対するリレーション

    //「1対多」の関係なので'posts'と複数形に
    public function posts()   
    {
        return $this->hasMany(Post::class);  
    }
    
    // Userに対するリレーション

    //「1対多」の関係なので単数系に
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        
    public static function booted(): void
    {
        static::deleted(function ($category) {
            $category->posts()->delete();
        });
    }
}