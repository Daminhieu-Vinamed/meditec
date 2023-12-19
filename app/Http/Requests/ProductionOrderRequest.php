<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductionOrderRequest extends FormRequest
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
            "ProductCode" => "array",
            "ProductCode.*"  => "required",
            "ItemLotCode" => "array",
            "ItemLotCode.*"  => "required",
            "QuantitySX" => "array",
            "QuantitySX.*"  => "nullable|numeric",
            "QuantityFail" => "array",
            "QuantityFail.*"  => "nullable|numeric",
            "WorkDay" => "array",
            "WorkDay.*"  => 'required|numeric',
            "DeptCodetmp" => "array",
            "DeptCodetmp.*"  => 'required',
        ];
    }
    public function messages()
    {
        return [
            'QuantitySX.*.numeric' => __('validation.product_order.is_number_quantity'),
            'QuantityFail.*.numeric' => __('validation.product_order.is_number_waste'),
            'ItemLotCode.*.required' => __('validation.product_order.required_item_lot_code'),
            'WorkDay.*.numeric' => __('validation.product_order.is_number_time'),
            'WorkDay.*.required' => __('validation.product_order.required'),
            'ProductCode.*.required' => __('validation.product_order.select_code'),
            'DeptCodetmp.*.required' => __('validation.product_order.required_factory'),
        ];
    }
}
