<?php
namespace App\Validator;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Input;
use Hash;
class CustomeValidator extends Validator
{
/**
* [validatecheckTagTitleExit To check tag name alredy used or not]
* @param  [type] $attribute  [description]
* @param  [type] $value      [description]
* @param  [type] $parameters [description]
* @return [type]             [description]
*/
public function validateCheckCountrynAlreadyExit($attribute, $value, $parameters)
{

    $country = \App\Country::where('country',$value)->first();

    if ($country == null) {
        
        return true;

    }else{

        return false;
    }


    
}

public function validateCheckCountryInUpdateAlreadyExist($attribute, $value, $parameters,$validator)
{
     
    

    $country = \App\Country::where('country',$value)->where('id',$parameters[0])->first();


   if ($country == null) {
        
        $sql=\App\country::where('country',$value)->first();

        if ($sql !=null) {
          return false;      
        }else{
            return true;
        }
        

    }else{

        return true;
    }    

    
}


public function validateCheckStateAlreadyExit($attribute, $value, $parameters)
{
    
    $state = \App\State::where('state',$value)->first();

    if ($state == null) {
        
        return true;

    }else{

        return false;
    }   
}


public function validateCheckStateInUpdateAlreadyExist($attribute, $value, $parameters,$validator)
{
   

    $state = \App\State::where('state',$value)->where('id',$parameters[0])->first();


   if ($state == null) {
        
        $sql=\App\State::where('state',$value)->first();

        if ($sql !=null) {
          return false;      
        }else{
            return true;
        }
        

    }else{

        return true;
    }    

}


public function validateCheckAreanAlreadyExit($attribute, $value, $parameters)
{

    $area = \App\area::where('area',$value)->first();

    if ($area == null) {
        
        return true;

    }else{

        return false;
    }    
}

public function validateCheckAreaInUpdateAlreadyExit($attribute, $value, $parameters)
{

    $area = \App\area::where('area',$value)->where('id',$parameters[0])->first();
 

    if ($area == null) {
        
        $sql=\App\area::where('area',$value)->first();

        if ($sql !=null) {
          return false;      
        }else{
            return true;
        }
        

    }else{

        return true;
    }    
}
}
?>
