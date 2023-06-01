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

    protected $fillable = [
        'name',
        'public'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function mealItems(): hasMany
    {
        return $this->hasMany(MealItem::class);
    }

    public function withMacros(string $selection = 'none')
    {
        $stats=[];
        $macros = Macro::macroList();
        foreach($macros as $macro){
            $stats[$macro] = 0;
        }

        foreach($this->mealItems()->with('macros')->get() as $mealItem){
            foreach($mealItem['macros'] as $macro){
                $stats[$macro['name']]+=$macro['value'];
            }
        }

        if($selection!='none' && array_key_exists($selection, $stats)){
            return [$selection => $stats[$selection]];
        }
        $this['stats'] = $stats;

        return $this;
    }
}
