<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{

    protected $types = ['breakfast', 'brunch', 'lunch', 'dinner', 'snack'];
    protected $iterations = 3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<$this->iterations;$i++){
            DB::table('meals')->insert([
                'type' => Arr::random($this->types),
                'user_id' => '1',
                'created_at' => now()
            ]);
        }
    }
}
