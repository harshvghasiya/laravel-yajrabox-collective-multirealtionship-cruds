<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class streat extends Model
{
	public $table='streats';

    public function area(){
    	return $this->belongsTo(area::class,'area_id','id');
    }
     public function state(){
    	return $this->belongsTo(state::class,'state_id','id');
    }
     public function country(){
    	return $this->belongsTo(country::class,'country_id','id');
    }
}
