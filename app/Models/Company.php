<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Job;
use App\Models\Contact;
use App\Models\Project;
use App\Models\Country;
use App\Models\State;
use App\User;


class Company extends Model
{
    use SoftDeletes;


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function jobs(){
        return $this->hasMany(Job::class, 'client_id', 'id');
    }


    public function contacts(){
        return $this->hasMany(Contact::class, 'account_id', 'id');
    }

    public function projects(){
        return $this->hasMany(Project::class, 'account_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state(){
        return $this->belongsTo(State::class, 'state');
    }
}
