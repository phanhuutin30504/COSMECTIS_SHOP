<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'password', 'mobile', 'email', 'login_by',
        'ward_id', 'shipping_name', 'shipping_mobile',
        'housenumber_street', 'is_active'
    ];

    protected $hidden = ['password'];
}
