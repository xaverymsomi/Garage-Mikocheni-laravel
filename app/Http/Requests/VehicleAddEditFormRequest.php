<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleAddEditFormRequest extends FormRequest
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
            'vehical_id' => 'required',
            'vehicabrand' => 'required',
            'fueltype' => 'required',
            'modelname' => 'required',
            // 'price' => 'required|numeric|regex:/^[0-9]*\d?(\.\d{1,2})?$/',
            'image' => 'nullable|mimes:jpg,png,jpeg',
            'branch' => 'required',
            'number_plate' => 'required|unique:tbl_vehicles,number_plate' . ($this->id ? ',' . $this->id : ''),
            // 'customer' => 'required',
            // 'vhi_for' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vehical_id.required' => trans('message.Vehicle type is required.'),
            'vehicabrand.required' => trans('message.Vehicle brand is required.'),
            'fueltype.required' => trans('message.Fuel type is required.'),
            'modelname.required' => trans('message.Model name is required.'),
            'price.required' => trans('message.Price is required.'),
            'price.regex'  => trans('message.Price is only numeric data allowed.'),
            'price.numeric' => trans('message.Price is only numeric data allowed.'),
            'image.mimes' => trans('message.Image must be a file of type: Jpg, Jpeg and Png.'),
            'branch.required' => trans('message.Branch field is required.'),
            'number_plate.required' => trans('message.Number Plate is required.'),
            'number_plate.unique' => trans('message.Number Plate you entered is already registered.'),
            'customer.required' => trans('message.Customer name required'),
            // 'vhi_for' => trans('message.Vehicle for is required.'),
        ];
    }
}
