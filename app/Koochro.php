<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Koochro extends Model
{
    protected $fillable = ['type', 'address_yeylagh', 'loc_yeylagh', 'fasele_az_shahrestan_yeylagh',
        'address_gheshlagh', 'loc_gheshlagh', 'fasele_az_shahrestan_gheshlagh', 'masire_kooch',
        'masafate_kooch', 'date_created', 'date_updated'];

    protected $table = 'koochros';

    public function schools()
    {
        return $this->morphMany(School::class, 'schoolable');
    }
}