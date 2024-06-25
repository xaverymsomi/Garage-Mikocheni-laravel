<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/*This file is form invoice salespart*/
class StoreInvoiceEditFormRequest extends FormRequest
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
            'Vehicle' => 'required',
            'Date' => 'required',
            'Status' => 'required',
            'Payment_type' => 'required',
            'grandtotal' => 'required',
            'paidamount' => 'required',
            'branch' => 'required',                    
        ];
    } 

    public function messages()
    {
        return [
            'Vehicle.required' => trans('message.Vehicle name is required.'),
            'Date.required' => trans('message.Invoice date is required.'),
            'Status.required' => trans('message.Status is required.'),
            'Payment_type.required' => trans('message.Payment type is required.'),
            'grandtotal.required'  => trans('message.Grand total is required.'),
            'paidamount.required'  => trans('message.Paid amount is required.'),
            'branch.required' => trans('message.Branch field is required.'),
        ];
    }
}
