<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'product_details';
    protected $primaryKey = 'product_detail_id';
    protected $fillable = ['product_id', 'price_sale', 'price', 'size_bitwise', 'color_bitwise'];
    public $timestamps = false;

    public function product_details()
    {
        return $this->hasOne('App\Models\Production', 'product_id');
    }
}