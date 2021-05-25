<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->HasMany('App\Models\OrderProduct', 'order_id');
    }

    // public function products()
    // {
    //     return $this->hasOne(OrderProduct::class);
    // }
}