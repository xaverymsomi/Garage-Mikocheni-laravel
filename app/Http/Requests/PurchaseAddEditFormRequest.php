<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseAddEditFormRequest extends FormRequest
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
            'p_no' => 'required',
            'p_date' => 'required',
            's_name' => 'required',
            'branch' => 'required',
            /*'mobile' => 'required',            
            'email' => 'required',
            'address' => 'required',*/
            'product.Manufacturer_id.*' => 'required',
            'product.product_id.*' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'p_no.required' => trans('message.Purchase number is required.'),
            'p_date.required' => trans('message.Purchase date is required.'),
            's_name.required' => trans('message.Supplier name is required.'),
            'branch.required' => trans('message.Branch field is required.'),        
            /*'mobile.required' => trans('message.Mobile number is required.'),
            'email.required' => trans('message.Email is required.'),
            'address.required' => trans('message.Address is required.'),*/
            'product.Manufacturer_id.*.required' => trans('message.Manufacturer name is required.'),
            'product.product_id.*.required' => trans('message.Product name is required.'),
        ];

    }
}
