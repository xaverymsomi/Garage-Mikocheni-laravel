<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRtoTaxAddEditFormRequest extends FormRequest
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
            'v_id' => 'required',
            'rto_tax' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'num_plate_tax' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'mun_tax' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'branch' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'v_id.required' => trans('message.Vehicle name is required.'),
            'rto_tax.required'  => trans('message.RTO tax is required.'),
            'rto_tax.numeric' => trans('message.RTO tax must be numeric data only.'),
            'rto_tax.regex' => trans('message.After point only two digit allowed.'),                      
            'num_plate_tax.required' => trans('message.Number plate charge is required.'),
            'num_plate_tax.numeric' => trans('message.Number plate charge must be numeric data only.'),
            'num_plate_tax.regex' => trans('message.After point only two digit allowed.'),
            'mun_tax.required' => trans('message.Municiple road tax is required.'),
            'mun_tax.numeric' => trans('message.Municiple road tax must be numeric data only.'),
            'mun_tax.regex' => trans('message.After point only two digit allowed.'),
            'branch.required' => trans('message.Branch field is required.'),
        ];

    }

}
