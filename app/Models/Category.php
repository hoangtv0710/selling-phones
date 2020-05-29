<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = [
        'name', 'slug', 'status', 
    ];

    public function productType()
    {
        return $this->hasMany('App\Models\ProductType', 'cate_id', 'id');
    }
}
