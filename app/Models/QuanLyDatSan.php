<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanLyDatSan extends Model
{
    use HasFactory;
    protected $table="dat_san";
    protected $fillable = ['tong_tien'
    ];
    public function user()
    {
        return $this->belongsTo(KhachHang::class);
    }
   
    public function san_bong()
    {
        return $this->belongsTo(SanBong::class);
    }
    public function gia_thue()
    {
        return $this->belongsTo(GiaThue::class);
    }
    public function trang_thai_dat_san()
    {
        return $this->belongsto(TrangThai::class);
    }
    public function thanhToan()
    {
        return $this->hasOne(ThanhToan::class, 'dat_san_id', 'id');
    }
    public function trang_thai_thanh_toan()
    {
        return $this->belongsTo(TrangThaiThanhToan::class);
    }
    public function lichSuDatSan()
    {
        return $this->hasOne(LichSu::class, 'dat_san_id');
    }
}
