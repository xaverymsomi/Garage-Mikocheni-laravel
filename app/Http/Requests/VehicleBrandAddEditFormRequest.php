<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleBrandAddEditFormRequest extends FormRequest
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
            'vehicalbrand' => 'required|regex:/^[(a-zA-Z0-9\s)\p{L}]+$/u|max:50',
            // 'vehicaltypes' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vehicaltypes.required' => trans('message.Vehicle type is required.'),
            'vehicalbrand.required' => trans('message.Vehicle brand is required.'),
            //'vehicaltype.alpha_spaces' => trans('message.Blank space not allowed.'),
            'vehicalbrand.regex' => trans('message.Special symbols are not allowed.'),
        ];

    }
}
