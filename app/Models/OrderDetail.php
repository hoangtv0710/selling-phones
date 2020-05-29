<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price',
    ];

    public function Order()
    {
        return $this->belongsTo('App\Models\Oder', 'order_id', 'id');
    }

    public function Product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
