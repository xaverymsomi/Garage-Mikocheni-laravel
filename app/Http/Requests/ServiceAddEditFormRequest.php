<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceAddEditFormRequest extends FormRequest
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
            'jobno' => 'required',
            'Customername' => 'required',
            'vehicalname' => 'required',
            'date' => 'required',
            'AssigneTo' => 'required',
            'repair_cat' => 'required',
            'charge' => 'required|numeric|regex:/^[0-9]*$/',
            //'title' => 'regex:/^[a-zA-Z][a-zA-Z0-9\s\.\-\_]*$/',
            'title' => 'regex:/^[(a-zA-Z\s)\p{N}\p{L}]+$/u',
            'branch' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'jobno.required' => trans('message.Jobcard number is required.'),
            'Customername.required' => trans('message.Customer name is required.'),
            'vehicalname.required' => trans('message.Vehicle name is required.'),
            'date.required' => trans('message.Service date is required.'),
            'AssigneTo.required' => trans('message.Assigne to is required.'),
            'repair_cat.required' => trans('message.Repair category is required.'),
            'charge.required' => trans('message.Service charge is required.'),
            'charge.numeric' => trans('message.Service charge is only numeric data.'),
            'charge.regex'  => trans('message.Service charge is only number data.'),
            'title.regex'  => trans('message.First character is an alphabet after alphanumeric, space, dot, comma, hyphen and underscore are allowed.'),
            'branch.required' => trans('message.Branch field is required.'),
        ];
    }
}
