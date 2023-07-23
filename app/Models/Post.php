<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    /**
     * Get the comments for the blog post.
    */
    public function post_metas(){
        return $this->hasMany('App\Models\PostExtra', 'post_id', 'id');
    }

    /**
     * 
     */
    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
