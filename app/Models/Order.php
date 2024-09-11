<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
         'order_status_id', 'staff_id', 'customer_id',
        'shipping_fullname', 'shipping_mobile', 'payment_method',
        'shipping_ward_id', 'shipping_housenumber_street',
        'delivered_date','shipping_fee'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'order_status_id', 'id');
    }
}
