<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Macro extends Model
{
    use HasFactory;

    public const TYPES = ["calories", "carbs", "fat", "fiber", "protein", "sodium", "sugar"];
    public const DISPLAY_UNIT_OPTIONS = ['g','mg'];

    public function mealItem(): BelongsTo
    {
        return $this->belongsTo(MealItem::class);
    }

    public static function defaultDisplayUnits()
    {
        return [
            "calories" => null,
            "carbs" => 'g',
            "fat" => 'g',
            "fiber"=> 'g',
            "protein"=> 'g',
            "sodium"=> 'mg',
            "sugar"=> 'g'
        ];
    }

    public static function statsContainer()
    {
        $stats = [];
        $macros = Macro::TYPES;
        foreach($macros as $macro){
            $stats[$macro] = 0;
        }
        return $stats;
    }
}
