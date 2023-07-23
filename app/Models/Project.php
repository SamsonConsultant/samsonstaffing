<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\Company;
use App\Models\Contact;
use App\User;


class Project extends Model
{
    public function jobs(){
        return $this->hasMany(Job::class, 'project_id', 'id');
    }

    public function contact(){
        return $this->belongsTo(Contact::class,'contact_id', 'id');
    }

    public function company(){
        return $this->belongsTo(Company::class,'account_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function job(){
        return $this->jobs()->take(7)->latest();
    }
}
