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
}