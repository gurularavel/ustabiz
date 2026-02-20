<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'avatar_initial', 'text', 'stars', 'date', 'is_active', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
        'stars'     => 'integer',
    ];
}
