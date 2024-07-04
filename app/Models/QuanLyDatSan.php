<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanLyDatSan extends Model
{
    use HasFactory;
    protected $table="dat_san";

    public function khachhang()
    {
        return $this->belongsTo(KhachHang::class);
    }
    public function trangthai()
    {
        return $this->belongsTo(TrangThai::class);
    }
    public function sanbong()
    {
        return $this->belongsTo(SanBongDa::class);
    }
}
