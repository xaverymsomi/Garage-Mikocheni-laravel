<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessHoursEditFormRequest extends FormRequest
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
            'adddate' => 'required',
            //'addtitle' => 'required|max:100|regex:/^[a-zA-Z][a-zA-Z0-9\s\.\@\-\_\,]*$/',
            'addtitle' => 'required|max:100|regex:/^[(a-zA-Z\s)\p{N}\p{L}]+$/u',
            //'adddescription' => 'nullable|max:300|regex:/^[a-zA-Z][a-zA-Z0-9\s\.\@\-\_\,]*$/',
            'adddescription' => 'nullable|max:300|regex:/^[(a-zA-Z\s)\p{N}\p{L}]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'adddate.required' => trans('message.Date is required.'),

            'addtitle.required'  => trans('message.Title is required.'),             
            'addtitle.regex'  => trans('message.After alphabet alphanumeric, space, dot, @, _, and - are allowed.'),
            'addtitle.max' => trans('message.Title field should not more than 100 character.'),

            'adddescription.regex'  => trans('message.After alphabet alphanumeric, space, dot, @, _, and - are allowed.'),
            'adddescription.max' => trans('message.Description should not more than 300 character.'),         
        ];

    }
}
