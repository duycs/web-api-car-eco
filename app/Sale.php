<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'seller_user_id', 'object_type_id', 'object_detail_id',
        'status', 'price', 'payment_type',
        'location_id', 'location_alias'
    ];
}
