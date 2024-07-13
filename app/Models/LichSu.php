<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSu extends Model
{
    use HasFactory;
    protected $table ="lich_su_dat_san";
    protected $fillable = [
        'dat_san_id',
        'tg_bat_dau_cu',
        'tg_ket_thuc_cu',
        'tong_tien_cu',
    ];

    public function quanLyDatSan()
    {
        return $this->belongsTo(QuanLyDatSan::class, 'dat_san_id');
    }
}
