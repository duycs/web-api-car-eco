<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectType extends Model
{
  protected $table = 'object_types';
  protected $fillable = ['name', 'description'];
}
