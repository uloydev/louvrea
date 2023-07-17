<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grand_total',
        'order_price',
        'shipping_price',
        'address',
        'address_detail',
        'phone',
        'shipping_method',
        'discount',
        'voucher_id',
        'awb_number',
        'full_name',
        'status',
    ];

    public function orderItems() 
    {
        return $this->hasMany(OrderItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

class OrderStatus
{
    const PENDING = 'PENDING';
    const PROCESSING = 'PROCESSING';
    const SHIPPING = 'SHIPPING';
    const FINISHED = 'FINISHED';
}

class ShippingMethod
{
    const KURIR_TOKO = 'KURIR TOKO';
}
