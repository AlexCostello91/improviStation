<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use App\Models\MealItem;
use App\Models\Macro;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class MacroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        return [
            'name' => $faker->unique()->randomElement(Macro::TYPES),
            'meal_item_id' => MealItem::all()->random()->id,
            'value' => $faker->numberBetween(1, 50),
            'display_unit' => $faker->randomElement(['g', 'mg'])
        ];
    }
}
