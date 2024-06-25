<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseAddEditFormRequest extends FormRequest
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
            'main_label' => 'required|regex:/^[(a-zA-Z0-9\s)\p{L}]+$/u',
            'status' => 'required',
            'date' => 'required',
            'expense_entry' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            //'expense_entry.*' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'branch' => 'required',
        ];

        /*$rules = [
            'main_label' => 'required|regex:/^[(a-zA-Z0-9\s)]+$/u',
            'status' => 'required',
            'date' => 'required',
            //'expense_entry' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            //'expense_entry.*' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
        ];*/

        /*if($this->request->get('expense_entry')){
            foreach($this->request->get('expense_entry') as $key => $val)
            {
                $rules['expense_entry.'.$key] = 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/';                
            }
        }*/

        //return $rules;

    }

    public function messages()
    {
        return [
            'main_label.required' => trans('message.Main label is required.'),
            'main_label.regex' => trans('message.Only alphanumeric and space allowed.'),
            'status.required' => trans('message.Status field is required.'),
            'date.required' => trans('message.Date is required.'),
            'expense_entry.required' => trans('message.Expense entry field is required.'),
            'expense_entry.numeric' => trans('message.Only numeric data allowed.'),
            'expense_entry.regex' => trans('message.After point two digit allowed.'),
            //'expense_entry.required' => trans('message.Expense entry field is required.'),
            //'expense_entry.numeric' => trans('message.Only numeric data allowed.'),
            //'expense_entry.regex' => trans('message.After point two digit allowed.'),
            'branch.required' => trans('message.Branch field is required.'),
        ];

    }
}
