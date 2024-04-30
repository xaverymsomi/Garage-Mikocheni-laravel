<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGatepassAddEditFormRequest extends FormRequest
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
            'jobcard' => 'required',
            'gatepass_no' => 'required',
            'Customername' => 'required',            
            'lastname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'vehiclename' => 'required',
            'veh_type' => 'required',
            'kms' => 'required|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'out_date' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'jobcard.required' => trans('message.Jobcard is required.'),
            'gatepass_no.required' => trans('message.Gatepass number is required.'),
            'Customername.required' => trans('message.First name is required.'),
            'lastname.required' => trans('message.Last name is required.'),
            'email.required' => trans('message.Email is required.'),
            'mobile.required' => trans('message.Contact number is required.'),
            'vehiclename.required' => trans('message.Vehicle name is required.'),
            'veh_type.required' => trans('message.Vehicle type is required.'),
            'kms.required' => trans('message.Kilometre is required.'),
            'kms.regex' => trans('message.Enter only numeric data.'),
            'out_date.required' => trans('message.Out date is required.'),
        ];

    }
}
