<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Workout;
use App\Models\Macro;
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
        $thisWeeksMeals = auth()->user()
        ->mealsInDateRange(now()->subDays(7), now())
        ->map(function ($meal) {
            return $meal->withMacroSummary();
        });

        $stats = Macro::statsContainer();

        foreach ($thisWeeksMeals as $meal) {
            foreach ($meal['macroSummary'] as $macro) {
                $stats[$macro['name']] += $macro['value'];
            }
        }

        $thisWeeksStats =  array_map(function ($val) {
            return number_format($val / 7, 0);
        }, $stats);

        $lastWeeksStats = auth()->user()
            ->mealsInDateRange(now()->subDays(14), now()->subDays(7))
            ->map(function ($meal) {
                return $meal->withMacroSummary();
            });

        $stats = Macro::statsContainer();

        foreach ($lastWeeksStats as $meal) {
            foreach ($meal['macroSummary'] as $macro) {
                $stats[$macro['name']] += $macro['value'];
            }
        }

        $lastWeeksStats =  array_map(function ($val) {
            return number_format($val / 7, 0);
        }, $stats);


        $mealStats[] = [
            'name' => 'Avg Calories Per Day',
            'stat' => $thisWeeksStats['calories'],
            'previousStat' => $lastWeeksStats['calories'] ,
            'change' => number_format((($thisWeeksStats['calories'] / ($lastWeeksStats['calories'] == 0 ? 1 : $lastWeeksStats['calories'])) - 1) * 100,0) . '%',
            'changeType' => $thisWeeksStats['calories'] > $lastWeeksStats['calories'] ? 'increase' : 'decrease'
        ];
        $mealStats[] = [
            'name' => 'Avg Protein Per Day',
            'stat' => $thisWeeksStats['protein'],
            'previousStat' => $lastWeeksStats['protein'] ,
            'change' => number_format((($thisWeeksStats['protein'] / ($lastWeeksStats['protein'] == 0 ? 1 : $lastWeeksStats['protein'])) - 1) * 100,0) . '%',
            'changeType' => $thisWeeksStats['protein'] > $lastWeeksStats['protein'] ? 'increase' : 'decrease'
        ];

        $thisWeekTotalDuration = $lastWeekTotalDuration
        = $thisWeekTotalIntensity = $lastWeekTotalIntensity = 0;

        //Aggregate Workouts
        $thisWeeksWorkouts = Workout::where('user_id', auth()->user()->id)
            ->where('created_at', '>', new Carbon('-7 days'))
            ->where('created_at', '<=', new Carbon())
            ->get();
        $lastWeeksWorkouts = Workout::where('user_id', auth()->user()->id)
            ->where('created_at', '>', new Carbon('-14 days'))
            ->where('created_at', '<=', new Carbon('-7 days'))
            ->get();

        foreach ($thisWeeksWorkouts as $workout) {
            $thisWeekTotalIntensity += $workout->intensity;
            $thisWeekTotalDuration += $workout->duration;
        }

        foreach ($lastWeeksWorkouts as $workout) {
            $lastWeekTotalIntensity += $workout->intensity;
            $lastWeekTotalDuration += $workout->duration;
        }

        (int) $durationChange = (($thisWeekTotalDuration / ($lastWeekTotalDuration == 0 ? 1 : $lastWeekTotalDuration)) - 1) * 100;
        $durationChangeDir = $durationChange <= 0 ? 'descrease' : 'increase';
        (int) $intensityChange = (
            (
                ($thisWeekTotalIntensity / max(count($thisWeeksWorkouts),1)) /
                (max($lastWeekTotalIntensity,1) / max(count($lastWeeksWorkouts),1))
            ) - 1) * 100;
        $intensityChangeDir = $intensityChange <= 0 ? 'descrease' : 'increase';

        $mealStats[] = [
            'name' => "Total Exercise",
            'stat' => number_format(($thisWeekTotalDuration), 0) . 'm',
            'previousStat' => number_format(($lastWeekTotalDuration), 0),
            'change' => number_format(abs($durationChange), 1) . '%',
            'changeType' => $durationChangeDir
        ];

        $mealStats[] = [
            'name' => "Avg Workout Intensity",
            'stat' => number_format(($thisWeekTotalIntensity / max(count($thisWeeksWorkouts),1)), 1),
            'previousStat' => number_format(($lastWeekTotalIntensity / max(count($lastWeeksWorkouts),1)), 1),
            'change' => number_format(abs($intensityChange), 1) . '%',
            'changeType' => $intensityChangeDir
        ];

        return Inertia::render('Dashboard', [
            'mealStats' => $mealStats,
            'dailyValues' => auth()->user()->getDailyTotalStats(30)
        ]);
    }
}
