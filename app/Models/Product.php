<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = [
        'name', 'image', 'slug', 'description', 'quantity', 'price', 'promotional', 'cate_id', 'productType_id', 'status',
    ];

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType', 'productType_id', 'id');
    }

    public function Category()
    {
        return $this->belongsTo('App\Models\Category', 'cate_id', 'id');
    }
}
