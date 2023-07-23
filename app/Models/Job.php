<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Project;
use App\Models\Company;
use App\Models\Location;
use App\User;

class Job extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];    

    public function company(){
        return $this->belongsTo(Company::class, 'client_id');
    }

    public function project(){
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function location(){
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function scopeSearchResults($query){
        return $query->when(!empty(request()->input('location', 0)), function($query) {
            $query->whereHas('location', function($query) {
                $query->whereId(request()->input('location'));
            });
        })
        ->when(!empty(request()->input('category', 0)), function($query) {
            $query->whereHas('categories', function($query) {
                $query->whereId(request()->input('category'));
            });
        })
        ->when(!empty(request()->input('search', '')), function($query) {
            $query->where(function($query) {
                $search = request()->input('search');
                $query->where('title', 'LIKE', "%$search%")
                    ->orWhere('short_description', 'LIKE', "%$search%")
                    ->orWhere('full_description', 'LIKE', "%$search%")
                    ->orWhere('job_nature', 'LIKE', "%$search%")
                    ->orWhere('requirements', 'LIKE', "%$search%")
                    ->orWhere('address', 'LIKE', "%$search%")
                    ->orWhereHas('company', function($query) use($search) {
                        $query->where('name', 'LIKE', "%$search%");
                    });
            });
        });
    }
}
