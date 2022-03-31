<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StateUpdValidationRequest extends FormRequest
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
            'state.required' => "Please add State Name.",
             'country.required' => "Please add Country Name.",
            'state.check_state_in_update_already_exist' => "Already Exist.",    
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
            'state' => 'required|CheckStateInUpdateAlreadyExist:'.$id.'',
            'country' => 'required'
        ];

    }
}
