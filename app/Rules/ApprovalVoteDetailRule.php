<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ApprovalVoteDetailRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($Quantity9)
    {
        $this->Quantity9 = $Quantity9;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($value === "string") {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.product_order.is_number_quantity');
    }
}