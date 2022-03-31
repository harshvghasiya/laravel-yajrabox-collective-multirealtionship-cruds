<?php

namespace App;

use App\State;
use App\country;
use App\streat;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    
       public function state()
    {
    	return $this->belongsTo(State::class,'state_id','id');
    }

         public function country()
    {
    	return $this->belongsTo(country::class,'country_id','id');
    }

      public function streat()
    {
    	return $this->hasMany(streat::class,'area_id','id');
    }

    public static function getStateDropdown($country_id)
    {
       return state::where([ ['status','Active'],
                             ['country_id',$country_id] ])->pluck('state','id')->toArray(); 
    }

}
