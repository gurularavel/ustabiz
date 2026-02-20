<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Service extends Model
{
    protected $fillable = ['name','slug','icon','description','hero_desc','price_from','is_active','sort_order','problems','brands','faqs'];

    protected $casts = [
        'problems'  => 'array',
        'brands'    => 'array',
        'faqs'      => 'array',
        'is_active' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
