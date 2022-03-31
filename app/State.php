<?php

namespace App;

use App\area;
use App\country;
use App\streat;
use Illuminate\Database\Eloquent\Model;


class State extends Model
{
    public function country()
    {
    	return $this->belongsTo(country::class,'country_id','id');
    }

     public function area()
    {
    	return $this->hasMany(area::class,'state_id','id');
    }

    public function streat()
    {
    	return $this->hasMany(streat::class,'state_id','id');
    }
    public static function getCountryDropdown()
    {

          return Country::where('status','Active')->pluck('country','id')->toArray();   
        
    }
   
   

}
