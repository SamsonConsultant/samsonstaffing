<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function country(){
        return $this->belongsTo('App\Models\Country','country_id','id')->withDefault(['name'=>'']);
    }
    
    public function getAdminStateList($request){
        $query = $this->newQuery();
        $query->select('states.*','countries.name as country_name');
        if(!empty($request->status)){
            $status = array_search($request->status,config('constant.status'));
            if(!empty($status)){
               $query->where('states.status',$status);
            }else if($request->status!='all'){
                $query->where('states.status',$request->status);
            }
            
        }else{
            $query->where('states.status',config('constant.status.active'));
        }

        if($request->filled('c')){
            $query->where('countries.name',$request->c);
        }
        if($request->filled('s')){
            $query->where('states.name',$request->s);
        }
        $query->join('countries','states.country_id','=','countries.id','left');
        $data = $query->orderBy('states.name')->orderBy('countries.name')->paginate(config('constant.adminPerPage'));
        return $data;
    }
}
