<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table = 'customer_group';
    protected $primaryKey = 'customer_group_id';
    public $timestamps = false;

    public function customer()
    {
        return $this->hasOne('App\Models\Customer');
    }
}