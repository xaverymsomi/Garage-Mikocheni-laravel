<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddEditFormRequest extends FormRequest
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
            'p_date' => 'required',
            'name' => 'required|regex:/^[(a-zA-Z0-9\s)\p{L}]+$/u|max:100',          
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'unit' => 'required',            
            'p_type' => 'required',            
            'price' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'sup_id' => 'required',
            'branch' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'p_date.required' => trans('message.Product date is required.'),

            'name.required' => trans('message.Name is required.'),
            'name.regex'  => trans('message.Name is only alphanumeric and space.'),
            'name.max' => trans('message.Name should not more than 100 character.'),

            //'image.image' => trans('message.The type of the uploaded file should be an image.'),
            'image.mimes' => trans('message.Image must be a file of type: Jpg, Jpeg and Png.'),

            'unit.required' => trans('message.Unit of measurement is required.'),
            'p_type.required' => trans('message.Manufacturer is required.'),

            'price.required' => trans('message.Price is required.'),            
            'price.numeric' => trans('message.Price is only numeric data allowed.'),
            'price.regex'  => trans('message.Price is only numeric data allowed.'),
            //'price.max' => trans('message.Price field maximum eight digit allowed.'),
            
            'sup_id.required' => trans('message.Supplier is required.'),
            'branch.required' => trans('message.Branch field is required.'),
        ];

    }
}
