<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saabet extends Model
{
    protected $fillable = ['address', 'loc', 'fasele_az_shahrestan'];

    protected $table = 'saabets';

    public function schools()
    {
        return $this->morphMany(School::class, 'schoolable');
    }
}
