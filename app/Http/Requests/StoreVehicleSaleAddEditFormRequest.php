<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleSaleAddEditFormRequest extends FormRequest
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
            'bill_no' => 'required',
            'date' => 'required',
            'cus_name' => 'required',
            'salesmanname' => 'required',
            'vehi_bra_name' => 'required',
            'vehicale_name' => 'required',
            'price' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'color' => 'required',
            'total_price' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'interval' => 'required',
            'no_of_services' => 'required',
            'assigne_to' => 'required',
            'branch' => 'required',    
        ];
    } 

    public function messages()
    {
        return [
            'bill_no.required' => trans('message.Bill no is required.'),
            'date.required' => trans('message.Sales date is required.'),
            'cus_name.required' => trans('message.Customer name is required.'),
            'salesmanname.required' => trans('message.Salesman name is required.'),
            'vehi_bra_name.required' => trans('message.Brand name is required.'),
            'vehicale_name.required' => trans('message.Model name is required.'),
            'price.required' => trans('message.Price is required.'),
            'price.regex'  => trans('message.Price is only numeric data allowed.'),
            'price.numeric' => trans('message.Price is only numeric data.'),
            'color.required' => trans('message.Color is required.'),
            'total_price.required' => trans('message.Total price is required.'),
            'total_price.regex'  => trans('message.After point only two digits allowed.'),
            'total_price.numeric' => trans('message.Total price is only numeric data.'),
            'interval.required' => trans('message.Interval is required.'),
            'no_of_services.required' => trans('message.Number of service field is required.'),
            'assigne_to.required'  => trans('message.Assigned to field is required.'),
            'branch.required' => trans('message.Branch field is required.'),
        ];
    }
}
