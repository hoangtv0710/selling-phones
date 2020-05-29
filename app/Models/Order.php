<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'code_order', 'user_id', 'name', 'address', 'email', 'phone', 'total_price', 'message', 'status'  ,'created_at',
    ];

    public function User()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
