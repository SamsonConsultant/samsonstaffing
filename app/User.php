<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laravel\Passport\HasApiTokens;

use App\Models\Role;
use App\Models\Country;
use App\Models\State;
use App\Models\UserExperince;
use App\Models\UserEducation;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    const ACTIVE = '1';
    const INACTIVE = '2';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','email','password','role_id','remember_token','status'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state(){
        return $this->belongsTo(State::class, 'state_id');
    }

    public function experience(){
        return $this->hasMany(UserExperince::class, 'user_id', 'id');
    }

    public function education(){
        return $this->hasMany(UserEducation::class, 'user_id', 'id');
    }

    public function getEducationListAttribute()
    {
        return $this->education->pluck('degree_name')->implode(',');
    }
}
