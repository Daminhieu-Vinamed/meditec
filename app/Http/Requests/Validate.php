<?php

namespace App\Http\Requests;

use App\Models\B20HrmShift;
use App\Models\B30JobRecordDetail;
use Illuminate\Foundation\Http\FormRequest;

class Validate extends FormRequest
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
            "QuantitySX" => "array",
            "QuantitySX.*"  => "nullable|numeric",
            "QuantityFail" => "array",
            "QuantityFail.*"  => "nullable|numeric",
            "WorkDay" => "array",
            "WorkDay.*"  => 'required|numeric',
            "type" => "required",
        ];
    }
    public function messages()
    {
        return [
            'QuantitySX.*.numeric' => 'Số lượng nhập vào phải là chữ số',
            'QuantityFail.*.numeric' => 'Phế phẩm nhập vào phải là chữ số',
            'WorkDay.*.numeric' => 'Số giờ nhập vào phải là chữ số',
            'WorkDay.*.required' => 'Số giờ không được để trống',
        ];
    }
}
