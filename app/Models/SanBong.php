<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanBong extends Model
{
    use HasFactory;
    protected $table="san_bong";
    protected $fillable = ['ten_san', 'loai_san_id', 'hinh_anh'];
}
