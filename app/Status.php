<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';

    public function product_warehouses() {
        return $this->hasMany('App\ProductWarehouse');
    }

    public function orders() {
        return $this->hasMany('App\Order');
    }

    public function orderUsers() {
        return $this->hasMany('App\OrderUser');
    }
}
