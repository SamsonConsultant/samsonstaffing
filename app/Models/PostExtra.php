<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostExtra extends Model
{
    protected $fillable = [
        'post_id', 'key_name', 'key_value',
    ];
}
