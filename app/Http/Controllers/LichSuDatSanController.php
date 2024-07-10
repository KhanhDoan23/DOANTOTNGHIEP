<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuanLyDatSan;
use Illuminate\Support\Facades\Auth;

class LichSuDatSanController extends Controller
{
    public function DanhSach()
    {
        $userId=auth('cus')->user()->id;
        $lichSuDatSan = QuanLyDatSan::where('user_id', $userId)->orderByDesc('id')->paginate(10);

        return view('user/lich-su-dat/lich-su', compact('lichSuDatSan'));
    }
    public function huyDatSan(Request $request, $id)
    {
        $datSan = QuanLyDatSan::find($id);
       
        if (empty($datSan)) {
            return redirect()->route('lich-su-dat-san')->with('error', 'Lịch Đặt Sân Không Tồn Tại');
        }
        if ($datSan->trang_thai_dat_san_id == 3) {
            return redirect()->route('lich-su-dat-san')->with('error', 'Lịch Đặt Sân đã được huỷ trước đó.');
        }
        $datSan->tg_bat_dau = null; 
        $datSan->tg_ket_thuc = null; 
        $datSan->trang_thai_dat_san_id = 3;
        $datSan->save();

        $lichDatSan = QuanLyDatSan::where('tg_bat_dau', $datSan->tg_bat_dau)
            ->where('tg_ket_thuc', $datSan->tg_ket_thuc)
            ->where('trang_thai_dat_san_id', 1) 
            ->get();

    
        foreach ($lichDatSan as $lich) {
            $lich->tg_bat_dau = null; 
            $lich->tg_ket_thuc = null; 
            $lich->trang_thai_dat_san_id = 3; 
            $lich->save();
        }
    
        return redirect()->route('lich-su-dat-san')->with('thong_bao', 'Huỷ Đặt Sân Thành Công');
    }
    
    
}
