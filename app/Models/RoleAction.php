<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAction extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = ['role_id', 'action_id'];

    protected $fillable = ['role_id', 'action_id'];
}
