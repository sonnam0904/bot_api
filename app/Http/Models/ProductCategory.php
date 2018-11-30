<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    protected $primaryKey = 'product_category_id';
    protected $fillable = ['category_name', 'category_desc'];
    public $timestamps = false;
}