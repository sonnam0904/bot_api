<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    public $timestamps = false;

    public function customer_group()
    {
        return $this->hasOne('App\Models\CustomerGroup', 'customer_group_id');
    }
}