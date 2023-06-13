<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
        $time = $faker->dateTimeInInterval('-90 days', '+90 days');
        return [
            'name' => $faker->meatName() . ' with ' . $faker->vegetableName(),
            'user_id' => User::all()->random()->id,
            'type' => Arr::random(['breakfast', 'brunch', 'lunch', 'dinner', 'snack']),
            'desc' => $faker->paragraph(),
            'public' => $faker->boolean(),
            'consumed_at' => $time,
            'created_at' => $time,
            'updated_at' => $time,
        ];
    }
}
