<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Post;

class Category extends Model
{
    public function parent(){
        return $this->belongsTo(Category::class);
    }

    public function children(){
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function post(){
        return $this->belongsToMany(Post::class);
    }
}
