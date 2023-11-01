<?php

namespace App\Http\Requests;

use App\Rules\ApprovalVoteDetailRule;
use Illuminate\Foundation\Http\FormRequest;

class ApprovalVoteDetailRequest extends FormRequest
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
            "Quantity9" => "array",
            "Quantity9.*"  => ["required", new ApprovalVoteDetailRule($this->Quantity9)],
            "TimeExcute" => "array",
            "TimeExcute.*"  => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'Quantity9.*.required' => __('validation.product_order.required_quantity'),
            'TimeExcute.*.numeric' => __('validation.product_order.is_number_time'),
            'TimeExcute.*.required' => __('validation.product_order.required'),
        ];
    }
}
