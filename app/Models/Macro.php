<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Macro extends Model
{
    use HasFactory;

    public function mealItem(): BelongsTo
    {
        return $this->belongsTo(MealItem::class);
    }

    //Pull all macro lists from 1 source
    public static function macroList()
    {
        return ["calories", "carbs", "fat", "fiber", "protein", "sodium", "sugar"];
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
        $macros = Macro::macroList();
        foreach($macros as $macro){
            $stats[$macro] = 0;
        }
        return $stats;
    }
}
