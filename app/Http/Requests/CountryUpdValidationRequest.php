<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CountryUpdValidationRequest extends FormRequest
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
            'country.required' => "Please add Coutry Name.",
            'country.check_country_in_update_already_exist' => "Already Exist.",
            

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
            'country' => 'required|CheckCountryInUpdateAlreadyExist:'.$id.'',

        ];

    }
}
