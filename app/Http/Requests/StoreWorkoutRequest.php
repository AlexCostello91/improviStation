<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UtcDateTime;

class StoreWorkoutRequest extends FormRequest
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
            'desc' => 'string|max:255|nullable',
            'duration' => 'required|integer|min:0|max:604800',
            'intensity' => 'integer|min:1|max:10|nullable',
            'calories' => 'integer|nullable|min:1',
            'started_at' => ['required', 'date', new UtcDateTime],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'You must enter a name for your workout.',
            'name.max' => 'The name is too long. Please choose a name under 64 characters.',
            'desc.max' => 'Your description is too long. Please limit it to 255 characters',
            'intensity' => 'The perceived intensity must be a whole number between 1 and 10.',
            'duration' => 'Please enter a whole number for the duration.',
            'calories' => 'Please use whole numbers greater than 0 for calories.',
        ];
    }
}
