<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanBong extends Model
{
    use HasFactory;
    protected $table="san_bong";
    public function loai_san()
    {
        return $this->belongsTo(LoaiSan::class);
    }
    public function gia_thue()
    {
        return $this->belongsTo(GiaThue::class);
    }
}
