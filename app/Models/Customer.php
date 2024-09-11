<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'password', 'mobile', 'email', 'login_by',
        'ward_id', 'shipping_name', 'shipping_mobile',
        'housenumber_street', 'is_active','activation_token'
    ];

    protected $hidden = ['password','activation_token'];
}
