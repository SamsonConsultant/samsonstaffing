<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Job;

class JobManageMent extends Model
{
    public function job(){
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
