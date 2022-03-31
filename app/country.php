<?php

namespace App;

use App\State;
use App\area;
use App\streat;
use Illuminate\Database\Eloquent\Model;

class country extends Model
{
    public function state()
    {
    	return $this->hasMany(State::class,'country_id','id');
    }

     public function area()
    {
    	return $this->hasMany(area::class,'country_id','id');
    }
     public function streat()
    {
    	return $this->hasMany(streat::class,'country_id','id');
    }
   

}
