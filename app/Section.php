<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';

    public function warehouse() {
        return $this->belongsTo('App\Warehouse', 'warehouseID');
    }

    public function aisle() {
        return $this->hasMany('App\Aisle', 'sectionID');
    }
}
