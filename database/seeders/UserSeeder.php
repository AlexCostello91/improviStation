<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Meal;
use App\Models\MealItem;



class UserSeeder extends Seeder
{

    protected $userCount = 3;
    protected $mealsPerUser = 4;
    protected $mealItemsPerMeal = 2;

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
                            ->count($this->mealItemsPerMeal)
                    )
                    ->count($this->mealsPerUser)
            )
            ->count($this->userCount)
            ->create();
    }
}
