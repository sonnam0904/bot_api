<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'production';
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_category_id', 'product_name', 'product_desc', 'product_create_date', 'product_update_date'];
    public $timestamps = false;

    public function product_details()
    {
        return $this->hasMany('App\Models\ProductDetails', 'product_id');
    }
}