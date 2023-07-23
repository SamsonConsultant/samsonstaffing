<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function country(){
        return $this->belongsTo('App\Models\Country','country_id','id');
    }

    public function state(){
        return $this->belongsTo('App\Models\State','state_id','id');
    }
    
    public function getAdminCityList($request){
        $query = $this->newQuery();
        $query->select('cities.*','states.name as state_name','countries.name as country_name');
        if(!empty($request->status)){
            $status = array_search($request->status,config('constant.status'));
            if(!empty($status)){
                $query->where('cities.status',$status);
            }else if($request->status!='all'){
                $query->where('cities.status',$request->status);
            }
            
        }else{
            $query->where('cities.status',config('constant.status.active'));
        }

        if($request->filled('ct')){
            $query->where('cities.name',$request->ct);
        }

        if($request->filled('s')){
            $query->where('states.name',$request->s);
        }

        if($request->filled('c')){
            $query->where('countries.name',$request->c);
        }
        $query->join('states','cities.state_id','=','states.id');
        $query->join('countries','cities.country_id','=','countries.id');
        $data = $query->orderBy('cities.name')->paginate(config('constant.adminPerPage'));
        return $data;
    }
}
