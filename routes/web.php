<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Meal;
use Illuminate\Support\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function ()
{
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function ()
{
    //Aggregate Dashboard Stats
    $thisWeekTotalCalories = $lastWeekTotalCalories = $thisWeekTotalProtein = $lastWeekTotalProtein = 0;
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
        'name' => 'Average Calories Per Day This Week',
        'stat' => number_format(($thisWeekTotalCalories / 7), 0),
        'previousStat' => number_format(($lastWeekTotalCalories / 7), 0),
        'change' => number_format(abs($calorieChange), 1) . '%',
        'changeType' => $calorieChangeDir
    ];
    $mealStats[] = [
        'name' => 'Total Excercise This Week',
        'stat' => number_format(150, 0),
        'previousStat' => number_format(180, 0),
        'change' => number_format(abs(180 - 150), 1) . '%',
        'changeType' => 'descrease'
    ];
    $mealStats[] = [
        'name' => 'Average Protein Per Day This Week',
        'stat' => number_format(($thisWeekTotalProtein / 7), 0),
        'previousStat' => number_format(($lastWeekTotalProtein / 7), 0),
        'change' => number_format(abs($proteinChange), 1) . '%',
        'changeType' => $proteinChangeDir
    ];

    return Inertia::render('Dashboard', [
        'mealStats' => $mealStats
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function ()
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('workouts', WorkoutController::class)
    ->only(['index', 'show'])
    ->middleware(['auth', 'verified']);

Route::resource('meals', MealController::class)
    ->only(['index', 'show'])
    ->middleware(['auth', 'verified']);

Route::resource('mealItems', MealItemController::class)
    ->only(['show'])
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
