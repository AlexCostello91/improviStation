<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Rules\MacroValidator;


class MealItemValidator implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_array($value)) {
            return false;
        }

        try {

            $validator = Validator::make(
                $value,
                [
                    'name' => 'required|string|max:64',
                    'desc' => 'required|string|max:255',
                    'quantity' => 'required|integer|min:1',
                    'macros' => 'required|array|min:1',
                    'macros.*'=> [new MacroValidator]
                ]
            );
            return !$validator->fails();
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid meal item.';
    }
}
