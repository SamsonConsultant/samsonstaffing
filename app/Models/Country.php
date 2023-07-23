<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function getAdminCountryList($request){
        $query = $this->newQuery();
        if(!empty($request->status)){
            $status = array_search($request->status,config('constant.status'));
            if(!empty($status)){
                $query->whereStatus($status);
            }else if($request->status!='all'){
                $query->whereStatus($request->status);
            }
            
        }else{
            $query->whereStatus(config('constant.status.active'));
        }

        if($request->filled('search')){
            $query->where('name',$request->search);
        }
        $data = $query->orderBy('name')->paginate(config('constant.adminPerPage'));
        return $data;
    }
}
