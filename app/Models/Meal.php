<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public static function getTypes()
    {
        return ['breakfast', 'brunch', 'lunch', 'dinner', 'snack'];
    }
}
