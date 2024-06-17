<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchAddEditFormRequest extends FormRequest
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
            'branchname' => 'required|max:100|regex:/^[(a-zA-Z0-9\s)\p{L}]+$/u',
            'contactnumber' => 'required|min:6|max:16|regex:/^[- +()]*[0-9][- +()0-9]*$/',
            //'email' => 'required|email|custom_email|custom_email|unique:users,email,'.$this->id,
            //'email' => 'required|email|custom_email|custom_email|unique:branches,branch_email,'.$this->id,
            'email' => 'required|email|custom_email|',
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'country_id' => 'required',
            'address' => 'required|max:200|regex:/^[(a-zA-Z0-9\s)\p{L}]+$/u',
        ];
    }


    public function messages()
    {
        return [
            'branchname.required' => trans('message.Branch name is required.'),
            'branchname.max' => trans('message.Branch name should not more than 100 character.'),
            'branchname.regex'  => trans('message.Only alphanumeric, space, dot, underscore, hyphen and @ are allowed.'),
            
            'contactnumber.required' => trans('message.Contact number is required.'),
            'contactnumber.min' => trans('message.Contact number minimum 6 digits.'),
            'contactnumber.max' => trans('message.Contact number maximum 16 digits.'),
            'contactnumber.regex' => trans('message.Contact number must be number, plus, minus and space only.'),

            'email.required' => trans('message.Email is required.'),
            'email.email'  => trans('message.Please enter a valid email address. Like : sales@mojoomla.com'),
            'email.unique' => trans('message.Email you entered is already registered.'),  
            'email.custom_email' => trans('message.Please enter a valid email address. Like : sales@mojoomla.com'),          
        
            'image.mimes' => trans('message.Image must be a file of type: Jpg, Jpeg and Png.'),

            'country_id.required' => trans('message.Country field is required.'),

            'address.required' => trans('message.Address is required.'),
            'address.max' => trans('message.Address should not more than 200 character.'),
            'address.regex'  => trans('message.Only alphanumeric, space, dot, underscore, hyphen and @ are allowed.'),
        ];

    }
}
