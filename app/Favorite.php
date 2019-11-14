<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  protected $table = 'favorites';
  protected $fillable = ['user_id', 'object_type_id', 'object_detail_id'];
}
