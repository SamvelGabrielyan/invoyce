<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegistrationRequest extends Request
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'         => 'required|regex:/^[a-zA-Z]+$/u',
            'last_name'          => 'required|regex:/^[a-zA-Z]+$/u',
            'company_name'       => 'required',
            'industry'           => 'required',
            'email'              => 'required|email|max:255|unique:users',
            'password'           => 'required',
            'term_and_condition' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'first_name.regex'            => 'You can only enter letters for first name.',
            'last_name.regex'             => 'You can only enter letters for last name.',
            'term_and_condition.required' => 'The terms and conditions field is required.',
        ];
    }
}
