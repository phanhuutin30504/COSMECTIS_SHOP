<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_date', 'order_status_id', 'staff_id', 'customer_id',
        'shipping_fullname', 'shipping_mobile', 'payment_method',
        'shipping_ward_id', 'shipping_housenumber_street', 'shipping_fee',
        'delivered_date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
