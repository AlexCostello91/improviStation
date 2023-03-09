<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Inertia\Inertia;


/**
 * Controller with one-off index function to keep web.php clean & tidy
 */
class DashboardController extends Controller
{
    public function index()
    {
        //TODO: Cleanup logic

        $thisWeekTotalCalories = $lastWeekTotalCalories
            = $thisWeekTotalProtein = $lastWeekTotalProtein
            = $thisWeekTotalDuration = $lastWeekTotalDuration
            = $thisWeekTotalIntensity = $lastWeekTotalIntensity = 0;

        //Aggregate Calories & Protein
        $thisWeeksMeals = Meal::where('user_id', auth()->user()->id)
            ->where('created_at', '>', new Carbon('-7 days'))
            ->where('created_at', '<=', new Carbon())
            ->get();
        $lastWeeksMeals = Meal::where('user_id', auth()->user()->id)
            ->where('created_at', '>', new Carbon('-14 days'))
            ->where('created_at', '<=', new Carbon('-7 days'))
            ->get();

        foreach ($thisWeeksMeals as $meal)
        {
            foreach ($meal->mealItems as $mealItem)
            {
                foreach ($mealItem->macros as $macro)
                {
                    if ($macro->name == 'calories')
                    {
                        $thisWeekTotalCalories += $macro->value;
                    }
                    elseif ($macro->name == 'protein')
                    {
                        $thisWeekTotalProtein += $macro->value;
                    }
                }
            }
        }

        foreach ($lastWeeksMeals as $meal)
        {
            foreach ($meal->mealItems as $mealItem)
            {
                foreach ($mealItem->macros as $macro)
                {
                    if ($macro->name == 'calories')
                    {
                        $lastWeekTotalCalories += $macro->value;
                    }
                    elseif ($macro->name == 'protein')
                    {
                        $lastWeekTotalProtein += $macro->value;
                    }
                }
            }
        }

        (int) $calorieChange = (($thisWeekTotalCalories / ($lastWeekTotalCalories == 0 ? 1 : $lastWeekTotalCalories)) - 1) * 100;
        $calorieChangeDir = $calorieChange <= 0 ? 'descrease' : 'increase';

        (int) $proteinChange = (($thisWeekTotalProtein / ($lastWeekTotalProtein == 0 ? 1 : $lastWeekTotalProtein)) - 1) * 100;
        $proteinChangeDir = $proteinChange <= 0 ? 'descrease' : 'increase';

        $mealStats[] = [
            'name' => 'Avg Calories Per Day This Week',
            'stat' => number_format(($thisWeekTotalCalories / 7), 0),
            'previousStat' => number_format(($lastWeekTotalCalories / 7), 0),
            'change' => number_format(abs($calorieChange), 1) . '%',
            'changeType' => $calorieChangeDir
        ];
        $mealStats[] = [
            'name' => 'Avg Protein Per Day This Week',
            'stat' => number_format(($thisWeekTotalProtein / 7), 0) . ' g',
            'previousStat' => number_format(($lastWeekTotalProtein / 7), 0),
            'change' => number_format(abs($proteinChange), 1) . '%',
            'changeType' => $proteinChangeDir
        ];


        //Aggregate Workouts
        $thisWeeksWorkouts = Workout::where('user_id', auth()->user()->id)
            ->where('created_at', '>', new Carbon('-7 days'))
            ->where('created_at', '<=', new Carbon())
            ->get();
        $lastWeeksWorkouts = Workout::where('user_id', auth()->user()->id)
            ->where('created_at', '>', new Carbon('-14 days'))
            ->where('created_at', '<=', new Carbon('-7 days'))
            ->get();

        foreach ($thisWeeksWorkouts as $workout)
        {
            $thisWeekTotalIntensity += $workout->intensity;
            $thisWeekTotalDuration += $workout->duration;
        }

        foreach ($lastWeeksWorkouts as $workout)
        {
            $lastWeekTotalIntensity += $workout->intensity;
            $lastWeekTotalDuration += $workout->duration;
        }

        (int) $durationChange = (($thisWeekTotalDuration / ($lastWeekTotalDuration == 0 ? 1 : $lastWeekTotalDuration)) - 1) * 100;
        $durationChangeDir = $durationChange <= 0 ? 'descrease' : 'increase';
        (int) $intensityChange = (
            (
                ($thisWeekTotalIntensity / count($thisWeeksWorkouts)) /
                (($lastWeekTotalIntensity == 0 ? 1 : $lastWeekTotalIntensity) / count($lastWeeksWorkouts))
            ) - 1) * 100;
        $intensityChangeDir = $intensityChange <= 0 ? 'descrease' : 'increase';

        $mealStats[] = [
            'name' => "Total Exercise This Week",
            'stat' => number_format(($thisWeekTotalDuration), 0). 'm',
            'previousStat' => number_format(($lastWeekTotalDuration), 0),
            'change' => number_format(abs($durationChange), 1) . '%',
            'changeType' => $durationChangeDir
        ];

        $mealStats[] = [
            'name' => "Avg Workout Intensity This Week",
            'stat' => number_format(($thisWeekTotalIntensity / count($thisWeeksWorkouts)), 1),
            'previousStat' => number_format(($lastWeekTotalIntensity / count($lastWeeksWorkouts)), 1),
            'change' => number_format(abs($intensityChange), 1) . '%',
            'changeType' => $intensityChangeDir
        ];

        return Inertia::render('Dashboard', [
            'mealStats' => $mealStats
        ]);
    }
}
