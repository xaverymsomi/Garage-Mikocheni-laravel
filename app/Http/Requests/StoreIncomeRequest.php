<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomeRequest extends FormRequest
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
            'invoice' => 'required',
            'status' => 'required',
            //'main_label' => 'required|max:50|regex:/^[a-zA-Z][a-zA-Z0-9\s\.\-\_]*$/',
            'main_label' => 'required|max:50|regex:/^[(a-zA-Z0-9\s)\p{N}\p{L}]+$/u',
            'date' => 'required',
            // 'Payment_type' => 'required',
            //'income_entry' => 'required|regex:^\d{0,10}(\.\d{0,2})?$',
            //'income_entry' => 'required|integer|not_in:0|regex:^[1-9][0-9]+',
            'income_entry' => 'required',
            'branch' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'invoice.required' => trans('message.Invoice number is required.'),

            'status.required'  => trans('message.Payment status is required.'),

            'date.required'  => trans('message.Income date is required.'),
            
            'main_label.required' => trans('message.Main label is required.'),
            'main_label.max' => trans('message.Main label should be less than 50 charachters.'),
            'main_label.regex' => trans('message.First character is an alphabet after number, space, dot, comma, hyphen,  underscore, at are allowed.'),

            // 'Payment_type.required' => trans('message.Payment method is required.'),

            'income_entry.required' => trans('message.Income entry is required.'),
            //'income_entry.integer' => trans('message.Only numeric data allowed.'),            
            //'income_entry.regex' => trans('message.Only numeric data allowed.'),
            //'income_entry.regex' => trans('message.Only numeric data allowed.'),
            'branch.required' => trans('message.Branch field is required.'),          
        ];

    }
}
