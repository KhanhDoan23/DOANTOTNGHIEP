<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class DangNhap extends Authenticatable
{
    use HasFactory;
    protected $table="admin";

    protected $fillable = [
        'ten',
        'dia_chi',
        'email',
        'ten_dang_nhap',
        'quyen_id'
    ];

    public function quyen()
    {
        return $this->belongsTo(Quyen::class);
    }
}
