<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saabet extends Model
{
    protected $fillable = ['address', 'loc'];

    protected $table = 'schools';
}
