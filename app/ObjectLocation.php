<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectLocation extends Model
{
    protected $table = 'object_locations';

    protected $fillable = ['object_type_id', 'object_detail_id', 'location_id', 'rating_number', 'description'];
}
