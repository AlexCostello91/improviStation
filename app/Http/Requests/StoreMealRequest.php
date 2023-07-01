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
        return true;
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

    public function messages()
    {
        return [
            'name.required' => 'You must enter a name for your meal.',
            'name.max' => 'Sorry, name is too long. Please choose a name under 64 characters.',
            'desc.required' => 'You must enter a description.',
            'desc.max' => 'Sorry, your description is too long. Please limit it to 255 characters',
            'meal_items.required' => 'New meals must contain at least 1 item.'
        ];
    }
}
