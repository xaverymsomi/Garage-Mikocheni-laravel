<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceAddEditFormRequest extends FormRequest
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
            'Invoice_type' => 'required',
            'Invoice_Number' => 'required',
            'Customer' => 'required',
            'Job_card' => 'required',
            'Vehicle' => 'required',
            'Customer' => 'required',
            'Date' => 'required',
            'Total_Amount' => 'required',
            'Status' => 'required',
            'Payment_type' => 'required',
            'grandtotal' => 'required',
            'paidamount' => 'required',                      
        ];
    } 

    public function messages()
    {
        return [
            'Invoice_type.required' => trans('message.Invoice type is required.'),
            'Invoice_Number.required' => trans('message.Invoice number is required.'),
            'Customer.required' => trans('message.Customer name is required.'),
            'Job_card.required' => trans('message.Jobcard number is required.'),
            'Vehicle.required' => trans('message.Vehicle name is required.'),
            'Customer.required' => trans('message.Customer name is required.'),
            'Date.required' => trans('message.Invoice date is required.'),
            'Total_Amount.required' => trans('message.Total amount is required.'),
            'Status.required' => trans('message.Status is required.'),
            'Payment_type.required' => trans('message.Payment type is required.'),
            'grandtotal.required'  => trans('message.Grand total is required.'),
            'paidamount.required'  => trans('message.Paid amount is required.'),
        ];
    }
}
