<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Navbar;

class Menu extends Model
{
    public function navbars(){
        return $this->hasMany(Navbar::class, 'menu_id', 'id');
    }

    public function getNavAttribute(){
        return $this->navbars()->pluck('route_id')->toArray();
    }
}
