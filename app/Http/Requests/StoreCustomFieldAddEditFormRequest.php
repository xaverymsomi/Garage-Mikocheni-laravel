<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomFieldAddEditFormRequest extends FormRequest
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
            'formname' => 'required',
            'labelname' => 'required|max:50|regex:/^[a-zA-Z0-9\s\p{L}]+$/u',
            //'labelname' => 'required|max:50|regex:/^[a-zA-Z0-9\s\p{L}\p{Devanagari}]*$/u',
            'typename' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'formname.required' => trans('message.Form name is required.'),
            'labelname.required'  => trans('message.Label name is required.'),
            'labelname.regex'  => trans('message.Start should be alphabets only after supports alphanumeric, space, dot, @, _, and - are allowed.'),
            'labelname.max' => trans('message.Label name should not more than 50 character.'),
            'typename.required' => trans('message.Type is required.'),
        ];

    }
}
