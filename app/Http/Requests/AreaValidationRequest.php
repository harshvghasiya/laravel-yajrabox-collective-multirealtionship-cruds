<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AreaValidationRequest extends FormRequest
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
             'area.check_arean_already_exit' => "Already Exist.",
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
         return [
            'country' => 'required',
            'area' => 'required|CheckAreanAlreadyExit',
            'state' => 'required'
        ];

    }
}
