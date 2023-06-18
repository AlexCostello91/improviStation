<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Macro;


class DisplayUnitValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $valid = false;
        if(in_array($value,Macro::DISPLAY_UNIT_OPTIONS) || is_null($value) || $value==''){
            $valid = true;
        }

        return $valid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute has an invalid display_unit value.';
    }
}
