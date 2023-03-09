<?php

namespace Database\Seeders;

use App\Models\Macro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Meal;
use App\Models\MealItem;
use App\Models\Workout;


class UserSeeder extends Seeder
{

    protected $userCount = 3;
    protected $mealsPerUser = 90;
    protected $mealItemsPerMeal = 3;
    protected $macrosPerMealItem = 4;
    protected $workoutsPerUser = 10;


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(
                Meal::factory()
                    ->has(
                        MealItem::factory()
                            ->has(
                                Macro::factory()
                                ->count($this->macrosPerMealItem)
                                ->sequence(
                                    ['name' => 'protein'],
                                    ['name' => 'fat'],
                                    ['name' => 'calories'],
                                    ['name' => 'sodium'],
                                )
                            )
                            ->count($this->mealItemsPerMeal)
                    )
                    ->count($this->mealsPerUser)
            )
            ->has(
                Workout::factory()
                ->count($this->workoutsPerUser)
            )
            ->count($this->userCount)
            ->create();
    }
}
