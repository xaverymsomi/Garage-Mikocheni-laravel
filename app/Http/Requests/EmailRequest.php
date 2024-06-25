<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'MAIL_DRIVER' => 'required',
            'MAIL_HOST' => 'required',
            'MAIL_PORT' => 'required',
            'MAIL_USERNAME' => 'required',
            'MAIL_PASSWORD' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'MAIL_DRIVER.required' => trans('message.Email Driver is required.'),
            'MAIL_HOST.required' => trans('message.SMTP Server is required.'),
            'MAIL_PORT.required' => trans('message.SMTP Port is required.'),
            'MAIL_USERNAME.required' => trans('message.Email Address is required.'),
            'MAIL_PASSWORD.required' => trans('message.Password is required.'),
        ];
    }
}
