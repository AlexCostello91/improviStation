<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\MealItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Requests\StoreWorkoutRequest;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),

    ]);
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),

    ]);
})->name('about');

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

// Route::get(
//     '/meal-items/search',
//     [MealItemController::class, 'search']
// )->middleware(['auth', 'verified'])->name('meal-items/search');

Route::get(
    '/meal-items/recent',
    [MealItemController::class, 'recent']
)->middleware(['auth', 'verified'])->name('meal-items/recent');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::resource('chirps', ChirpController::class)
//     ->only(['index', 'store', 'update', 'destroy'])
//     ->middleware(['auth', 'verified']);

Route::resource('workouts', WorkoutController::class)
    ->only(['index', 'show', 'create'])
    ->middleware(['auth', 'verified']);

// Use Precognition for new workout form
Route::post('/workouts', [WorkoutController::class, 'store'])->middleware(['auth', 'verified', HandlePrecognitiveRequests::class]);

Route::resource('meals', MealController::class)
    ->only(['index', 'show', 'create'])
    ->middleware(['auth', 'verified']);

// Use Precognition for new meal form
Route::post('/meals', [MealController::class, 'store'])->middleware(['auth', 'verified', HandlePrecognitiveRequests::class]);


require __DIR__ . '/auth.php';
