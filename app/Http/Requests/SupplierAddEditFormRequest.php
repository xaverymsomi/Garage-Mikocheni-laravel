<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierAddEditFormRequest extends FormRequest
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
            'firstname' => 'required|regex:/^[(a-zA-Z\s)\p{L}]+$/u|max:50',
            'lastname' => 'required|regex:/^[(a-zA-Z\s)\p{L}]+$/u|max:50',
            'displayname' => 'required|max:100|regex:/^[(a-zA-Z\s)\p{L}]+$/u',
            'email' => 'required|email|custom_email|unique:users,email,NULL,id,soft_delete,0' . $this->id,
            'mobile' => 'required|min:6|max:16|regex:/^[- +()]*[0-9][- +()0-9]*$/',
            'landlineno' => 'nullable|min:6|max:16|regex:/^[- +()]*[0-9][- +()0-9]*$/',
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'country_id' => 'required',
            'address' => 'required',
            //'branch' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'firstname.required' => trans('message.First name is required.'),
            'firstname.regex'  => trans('message.First name is only alphabets and space.'),
            'firstname.max' => trans('message.First name should not more than 50 character.'),

            'lastname.required' => trans('message.Last name is required.'),
            'lastname.regex'  => trans('message.Last name is only alphabets and space.'),
            'lastname.max' => trans('message.Last name should not more than 50 character.'),
            
            'displayname.required' => trans('message.Company name is required.'),
            'displayname.regex'  => trans('message.Only alphanumeric, space, dot, @, _, and - are allowed.'),
            'displayname.max' => trans('message.Company name should not more than 100 character.'),

            //'dob.required' => trans('message.Date of birth is required.'),

            'email.required' => trans('message.Email is required.'),
            'email.email'  => trans('message.Please enter a valid email address. Like : sales@mojoomla.com'),
            'email.unique' => trans('message.Email you entered is already registered.'),
            'email.custom_email' => trans('message.Please enter a valid email address. Like : sales@mojoomla.com'),

            'mobile.required' => trans('message.Contact number is required.'),
            //'mobile.numeric'  => trans('message.Contact number only numbers are allowed.'),
            'mobile.min' => trans('message.Contact number minimum 6 digits.'),
            'mobile.max' => trans('message.Contact number maximum 16 digits.'),
            'mobile.regex' => trans('message.Contact number must be number, plus, minus and space only.'),

            'landlineno.numeric'  => trans('message.Landline number only numbers are allowed.'),
            //'landlineno.digits_between' => trans('message.Landline number must be digits between 6 to 12 digits.'),
            'landlineno.min' => trans('message.Landline number minimum 6 digits.'),
            'landlineno.max' => trans('message.Landline number maximum 16 digits.'),
            'landlineno.regex' => trans('message.Landline number must be number, plus, minus and space only.'),

            //'image.image' => trans('message.Image must be a file of type: Jpg, Jpeg and Png.'),
            'image.mimes' => trans('message.Image must be a file of type: Jpg, Jpeg and Png.'),

            'country_id.required' => trans('message.Country field is required.'),
            'address.required'  => trans('message.Address field is required.'),
            //'branch.required' => trans('message.Branch field is required.'),
        ];

    }
}
