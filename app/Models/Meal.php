<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Client\Request;
use Illuminate\Pagination\Paginator;


class Meal extends Model
{
    use HasFactory;

    public const TYPES = ['breakfast', 'brunch', 'lunch', 'dinner', 'snack'];

    protected $fillable = [
        'name',
        'public',
        'desc',
        'consumed_at',
        'type'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mealItems(): hasMany
    {
        return $this->hasMany(MealItem::class);
    }

    public function withMacroSummary(bool $withDisplayUnit = false)
    {
        $stats=[];
        $macros = Macro::TYPES;
        $defaultDisplayUnits = Macro::defaultDisplayUnits();
        foreach($macros as $macro){
            $stats[] = [
                'name' => $macro,
                'display_unit' => $defaultDisplayUnits[$macro],
                'value'=> 0
            ];
        }

        foreach($this->mealItems()->with('macros')->get() as $mealItem){
            foreach($mealItem['macros'] as $macro){
                $index = null;
                $searchValue = $macro['name'];
                array_walk($stats, function ($value, $key) use ($searchValue, &$index) {
                    if ($value['name'] === $searchValue) {
                        $index = $key;
                    }
                });
                if(!is_null($index)){
                    $amountToAdd = $macro['value'] * $mealItem['quantity'];
                    if($macro['display_unit']==='mg' &&  $stats[$index]['display_unit']==='g'){
                        $amountToAdd/=1000;
                    }
                    if($macro['display_unit']==='g' &&  $stats[$index]['display_unit']==='mg'){
                        $amountToAdd*=1000;
                    }
                    $stats[$index]['value']+=$amountToAdd;
                }
            }
        }

        $this['macroSummary'] = $stats;

        return $this;
    }
}
