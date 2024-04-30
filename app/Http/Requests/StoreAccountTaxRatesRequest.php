<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountTaxRatesRequest extends FormRequest
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
            //'taxrate' => 'required|max:50|regex:/^[a-zA-Z][a-zA-Z0-9\s\.\@\-\_\%\()]*$/',
            'taxrate' => 'required|max:50|regex:/^[(a-zA-Z\s)\p{N}\p{L}]+$/u',
            // 'taxrate' => 'required|max:50',
            'tax' => 'required|between:0,99.99',
            'tax_number' => 'required',
            
            
        ];
    }

    public function messages()
    {
        return [
            'taxrate.required' => trans('message.Tax name is required.'),
            'taxrate.regex'  => trans('message.Only alphanumeric, space, dot, @, _, % and - are allowed.'),
            'taxrate.max' => trans('message.Tax name should not more than 50 character.'),

            'tax.required' => trans('message.Tax rate is required.'),
            'tax.digits_between' => trans('message.The tax must be between 1 and 4 digits.'),
            'tax_number.required' => trans('message.Tax number is required.'),
            
        ];

    }
}
