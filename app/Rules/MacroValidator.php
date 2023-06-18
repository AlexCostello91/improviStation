<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use App\Models\Macro;
use App\Rules\DisplayUnitValidator;

class MacroValidator implements Rule
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
        if (!is_array($value)) {
            return false;
        }

        try {

            $validator = Validator::make(
                $value,
                [
                    'name' => ['required','string', ValidationRule::in(Macro::TYPES)],
                    'value' => 'required|integer|min:0',
                    'display_unit' => [new DisplayUnitValidator]
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
        return 'The :attribute must be a valid macro.';
    }
}
