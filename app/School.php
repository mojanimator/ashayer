<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['province_id', 'name', 'code_madrese', 'code_faza', 'sale_tasis', 'doore', 'tedad_daneshamooz'
        , 'vaziat', 'jensiat', 'tedad_paye_tahsili', 'tedad_hamkaran', 'noe_fazaye_amoozeshi', 'hooze_namayandegi_id',
        'schoolable_type', 'is_roozane', 'schoolable_id', 'date_created', 'date_updated'];

    protected $table = 'schools';

    public function schoolable()
    {
        return $this->morphTo('schoolable');
    }

    public function docs()
    {
        return $this->hasMany(Doc::class, 'school_id');
    }

    public function hooze()
    {
        return $this->belongsTo(Hooze::class, 'hooze_namayandegi_id');
    }
}
