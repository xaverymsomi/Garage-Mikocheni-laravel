<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileSettingEditFormRequest extends FormRequest
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
            // 'lastname' => 'required|regex:/^[(a-zA-Z\s)\p{L}]+$/u|max:50',
            'email' => 'required|email|custom_email|unique:users,email,NULL,id,soft_delete,0'.$this->id,
            'password'=> ($this->id)?'nullable|min:6|max:12|regex:/^(?=.*[a-zA-Z\p{L}])(?=.*\d).+$/u':'min:6|max:12|regex:/^(?=.*[a-zA-Z\p{L}])(?=.*\d).+$/u',
            'password_confirmation' => ($this->id)?'same:password':'same:password',
            'mobile' => 'nullable|min:6|max:16|regex:/^[- +()]*[0-9][- +()0-9]*$/',
            // 'image' => 'nullable|mimes:jpg,png,jpeg',
        ];
    }


    public function messages()
    {
        return [
            'firstname.required' => trans('message.First name is required.'),
            'firstname.regex'  => trans('message.First name is only alphabets and space.'),
            'firstname.max' => trans('message.First name should not more than 50 character.'),

            // 'lastname.required' => trans('message.Last name is required.'),
            // 'lastname.regex'  => trans('message.Last name is only alphabets and space.'),
            // 'lastname.max' => trans('message.Last name should not more than 50 character.'),
            
            'email.required' => trans('message.Email is required.'),
            'email.email'  => trans('message.Please enter a valid email address. Like : sales@mojoomla.com'),
            'email.unique' => trans('message.Email you entered is already registered.'),
            'email.custom_email' => trans('message.Please enter a valid email address. Like : sales@mojoomla.com'),

            //'password.required' => trans('message.Password is required.'),
            'password.regex'  => trans('message.Password must be combination of letters and numbers.'),
            'password.min' => trans('message.Password length minimum 6 character.'),
            'password.max' => trans('message.Password length maximum 12 character.'),

            //'password_confirmation.required' => trans('message.Confirm password is required.'),
            'password_confirmation.same'  => trans('message.Password and Confirm Password does not match.'),
            'password_confirmation.min' => trans('message.Password length minimum 6 character.'),
            'password_confirmation.max' => trans('message.Password length maximum 12 character.'),

            //'mobile.required' => trans('message.Contact number is required.'),
            //'mobile.numeric'  => trans('message.Contact number only numbers are allowed.'),
            'mobile.min' => trans('message.Contact number minimum 6 digits.'),
            'mobile.max' => trans('message.Contact number maximum 16 digits.'),
            'mobile.regex' => trans('message.Contact number must be number, plus, minus and space only.'),

            // 'image.mimes' => trans('message.Image must be a file of type: Jpg, Jpeg and Png.'),
            //'image.mimes' => trans('message.Image must be a file of type: Jpg, Jpeg and Png.'),
        ];

    }
}
