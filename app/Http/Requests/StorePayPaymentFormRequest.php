<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePayPaymentFormRequest extends FormRequest
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
            'Date' => 'required',
            'Payment_type' => 'required',
            'receiveamount' => 'required',                  
        ];
    } 

    public function messages()
    {
        return [
            'Date.required' => trans('message.Invoice date is required.'),
            'Payment_type.required' => trans('message.Payment type is required.'),
            'receiveamount.required'  => trans('message.Amount received is required.'),
        ];
    }
}
