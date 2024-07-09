<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhToan extends Model
{
    use HasFactory;
    protected $table="thanh_toan";
    public function dat_san()
    {
        return $this->belongsTo(QuanLyDatSan::class, 'dat_san_id', 'id');
    }
    public function gia_thue()
    {
        return $this->belongsTo(GiaThue::class);
    }
    public function trang_thai_thanh_toan()
    {
        return $this->belongsTo(TrangThaiThanhToan::class);
    }
}
