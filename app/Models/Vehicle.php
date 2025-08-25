<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'type',
        'brand',
        'model',
        'version',
        'year_model',
        'year_build',
        'optionals',
        'doors',
        'board',
        'chassi',
        'transmission',
        'km',
        'description',
        'sold',
        'category',
        'url_car',
        'old_price',
        'price',
        'color',
        'fuel',
        'fotos',
    ];

    protected $casts = [
        'optionals' => 'array',
        'fotos' => 'array',
        'sold' => 'boolean',
        'old_price' => 'decimal:2',
        'price' => 'decimal:2',
    ];
}
