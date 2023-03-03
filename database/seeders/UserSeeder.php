<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Meal;


class UserSeeder extends Seeder
{

    protected $userCount = 3;
    protected $mealsPerUser = 4;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->has(
                Meal::factory()->count($this->mealsPerUser)
            )
            ->count($this->userCount)
            ->create();
    }
}
