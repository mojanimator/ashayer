<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Madrese extends Model
{
    protected $fillable = ['name', 'location', 'students'];
}
