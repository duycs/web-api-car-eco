<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = [
        'name', 'brand_id', 'model_id',
        'year_manufacture', 
        //'price', 
        'product_status',
        'kilometers_number', 'gearbox_number', 'fuel',
        'color_id', 'rating_number', 'door_number',
        'engine_name', 'power_number', 'furniture_type',
        'exterior_type', 'equipment_type', 'description',
        'photos'
    ];
}
