<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AreaUpdValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'area.required' => "Please Add Area Name.",
             'area.check_area_in_update_already_exit' => "Already Exist.",
             'country.required' => "Select Valid  Country Name.",
             'state.required' => "Select Valid State Name.",
           
    
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $input=$request->all();
        $id= !empty($input['id']) ? $input['id'] : "";
         return [
            'country' => 'required',
            'area' => 'required|CheckAreaInUpdateAlreadyExit:'.$id.'',
            'state' => 'required'
         

        ];

    }
}
