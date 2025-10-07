<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = [
        'car_brand',
        'car_model',
        'car_price',
        'car_fuel_type',
        'car_color',
        'year',
        'owner_type',
        'image'
    ];
}
