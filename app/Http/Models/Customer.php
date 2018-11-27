<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';
    protected $fillable = ['address', 'customer_name', 'customer_group_id', 'email', 'mobile', 'dob', 'mob', 'yob', 'last_active', 'facebook_id', 'facebook_sender_id', 'created_date', 'updated_date'];
    public $timestamps = false;

    public function customer_group()
    {
        return $this->hasOne('App\Models\CustomerGroup', 'customer_group_id','customer_group_id');
    }
}