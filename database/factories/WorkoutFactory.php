<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class WorkoutFactory extends Factory
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
        return [
            'name' => $faker->randomElement([
                'Walking',
                'Running',
                'Cycling',
                'Swimming',
                'Weight Lifting'
            ]),
            'user_id' => User::all()->random()->id,
            'calories' => $faker->numberBetween(100,750),
            'intensity' => $faker->numberBetween(1,10),
            'duration' => $faker->numberBetween(15,120),
            'created_at' => $faker->dateTimeInInterval('-14 days', '+14 days')
        ];
    }
}
