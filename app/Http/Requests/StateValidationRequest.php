<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StateValidationRequest extends FormRequest
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
            'state.check_state_already_exit' => "Already Exist.",    
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
            'state' => 'required|CheckStateAlreadyExit',
            'country' => 'required'
        ];

    }
}
