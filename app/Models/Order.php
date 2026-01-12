<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'first_name',
        'last_name',
        'contact_number',
        'address',
        'payment_method',
        'total',
        'placed_at',
    ];

    protected $dates = ['placed_at'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
