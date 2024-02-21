<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    // Categoryに対するリレーション

    //「1対多」の関係なので単数系に
    public function category()
        {
        return $this->belongsTo(Category::class);
        }

    // Userに対するリレーション

    //「1対多」の関係なので単数系に
    public function user()
        {
        return $this->belongsTo(User::class);
        }

    // Priorityに対するリレーション

    //「1対多」の関係なので単数系に
    public function priority()
        {
         return $this->belongsTo(Priority::class);
        }
}