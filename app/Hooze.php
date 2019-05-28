<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hooze extends Model
{
    protected $fillable = ['name', 'parent_id'];

    protected $table = 'hoozes';
}
