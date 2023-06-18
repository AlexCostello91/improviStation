<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use App\Models\Macro;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class);
    }

    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class);
    }

    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class);
    }

    public function mealsFromLastXDays(int $days)
    {
        return $this->meals()
            ->where('consumed_at', '>=', now()->subDays($days))
            ->orderBy('consumed_at', 'asc')
            ->get();
    }

    public function mealsInDateRange(Carbon $start, Carbon $end)
    {
        return $this->meals()
            ->where('consumed_at', '>=', $start)
            ->where('consumed_at', '<=', $end)
            ->orderBy('consumed_at', 'asc')
            ->get();
    }

    //TODO fix daily stats for graph, factor in mg to G conversion
    public function getDailyTotalStats(int $days)
    {
        //Create container for last 30 days
        $stats = [];
        $statsCont = Macro::statsContainer();
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $tmp = $statsCont;
            $tmp['date'] = $date->toDateString();
            $stats[] = $tmp;
        }

        //Get all meals for last 30 days
        $meals = auth()->user()
            ->mealsInDateRange(now()->subDays(30), now())
            ->map(function ($meal) {
                return $meal->withMacroSummary();
            });

        //Aggregate them for a daily total
        foreach ($meals as $meal) {
            $date = new Carbon($meal['consumed_at']);
            $index = $this->findArrayIndexByValue($stats, 'date', $date->format('Y-m-d'));
            if(!is_null($index)){
                $stats[$index] = $this->mergeMacros($stats[$index], $meal['macroSummary']);
            }
        }

        return $stats;
        //Load workout stats for each day


    }

    protected function mergeMacros(array $container, array $toBeMerged)
    {
        $keys = Macro::TYPES;

        foreach($keys as $key){
            $index = $this->findArrayIndexByValue($toBeMerged, 'name', $key);

            if(!is_null($index)){
                $container[$key]+=$toBeMerged[$index]['value'];
            }
        }
        return $container;
    }

    protected function findArrayIndexByValue($array, $key, $desiredValue) {
        $index = array_search($desiredValue, array_column($array, $key));
        if ($index !== false) {
            return $index;
        }
        return null; // If no matching element is found
    }
}
