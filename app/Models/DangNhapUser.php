<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class DangNhapUser extends Authenticatable
{
    use HasFactory;

    protected $table = "user";

    protected $fillable = [
        'ho_ten',
        'email',
        'password',
        'so_dien_thoai',
    ];

}
