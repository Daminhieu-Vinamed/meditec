<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductionOrder2Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "Employee" => "array",
            "Employee.*"  => "required",
            "ProductCode" => "array",
            "ProductCode.*"  => "required",
            "ItemLotCode" => "array",
            "ItemLotCode.*"  => "required",
            "QuantitySX" => "array",
            "QuantitySX.*"  => "required|numeric",
            "WorkDay" => "array",
            "WorkDay.*"  => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'QuantitySX.*.required' => __('validation.product_order.required_quantity'),
            'WorkDay.*.required' => __('validation.product_order.required_workday'),
            'QuantitySX.*.numeric' => __('validation.product_order.is_number_quantity'),
            'WorkDay.*.numeric' => __('validation.product_order.is_number_time'),
            'ProductCode.*.required' => __('validation.product_order.select_product_code'),
            'Employee.*.required' => __('validation.product_order.select_user_code'),
        ];
    }
}