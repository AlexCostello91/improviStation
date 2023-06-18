<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\UtcDateTime;
use App\Rules\MealItemValidator;
use App\Models\Meal;

class StoreMealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Verify the user for the new Meal is the user making the request
        return $this->user()->id == $this->input('user_id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:64',
            'desc' => 'required|string|max:255',
            'public' => 'required|boolean',
            'type' => ['required', Rule::in(Meal::TYPES)],
            'consumed_at' => ['required', 'date', new UtcDateTime],
            'meal_items' => 'required|array|min:1',
            'meal_items.*' => [new MealItemValidator]
        ];
    }
}
