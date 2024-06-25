<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceSecondStepAddFormRequest extends FormRequest
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
            'out_date' => 'required',
            'kms' => 'required|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
        ]; 
    }


    public function messages()
    {
        return [
            'out_date.required' => trans('message.Out time date is required.'),

            'kms.required' => trans('message.Kilometre is required.'),
            //'kms.integer' => trans('message.Only numeric data allowed.'),            
            'kms.regex' => trans('message.Only numeric data allowed.'),
        ];

    }
}
