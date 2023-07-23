<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
use App\Models\Company;
use App\User;


class Contact extends Model
{
    public function projects(){
        return $this->hasMany(Project::class, 'contact_id', 'id');
    }

    public function company(){
        return $this->belongsTo(Company::class,'account_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }
}
