<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentMethodRequest extends FormRequest
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
            'payment' => 'required|regex:/^[(a-zA-Z\s)\p{L}]+$/u|max:50',
            
            
        ];
    }

    public function messages()
    {
        return [
            'payment.required' => trans('message.Payment method is required.'),
            'payment.regex'  => trans('message.Payment method allowed only alphabets and space.'),
            'payment.max' => trans('message.Payment method should not more than 50 character.'),
            
        ];

    }
}
