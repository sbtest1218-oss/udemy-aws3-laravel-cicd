<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'phase',
        'phase_order',
        'phase_icon',
        'title',
        'subtitle',
        'description',
        'icon',
        'position',
        'completed',
        'is_final',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'is_final' => 'boolean',
        'phase_order' => 'integer',
        'position' => 'integer',
    ];
}
