<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportDataFormRequest extends FormRequest
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
            'csv_file' => 'required|mimes:csv',
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => trans('message.File is required.'),
            'csv_file.mimes' => trans('message.File type must be csv.'),
        ];
    }
}
