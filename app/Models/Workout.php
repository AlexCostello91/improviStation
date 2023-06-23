<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workout extends Model
{
    public const TYPES =[
        'Walking',
        'Running',
        'Cycling',
        'Swimming',
        'Weight Lifting'
    ];

    use HasFactory;

    protected $fillable = [
        'name',
        'intensity',
        'duration',
        'started_at',
        'calories',
        'desc'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
