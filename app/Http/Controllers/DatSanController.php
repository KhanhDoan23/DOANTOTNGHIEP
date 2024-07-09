<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanBong;
use App\Models\GiaThue;
use App\Models\QuanLyDatSan;

class DatSanController extends Controller
{
    public function show($id)
    {
        $dsSanBong = SanBong::findOrFail($id);
        $giaThue = GiaThue::findOrFail($dsSanBong->gia_thue_id);

        return view('user/dat-san/chon-thoi-gian', compact('dsSanBong', 'giaThue'));
    }

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tg_bat_dau' => 'required|date',
            'tg_ket_thuc' => 'required|date|after:tg_bat_dau',
        ]);
        $sanBong = SanBong::findOrFail($id);
        $giaThue = GiaThue::findOrFail($sanBong->gia_thue_id);
        $tongTien = $this->tinhTongTien($request->tg_bat_dau, $request->tg_ket_thuc, $giaThue);
        $datSan = new QuanLyDatSan();
        $datSan->san_bong_id = $sanBong->id;
        $datSan->tg_bat_dau = $request->tg_bat_dau;
        $datSan->tg_ket_thuc = $request->tg_ket_thuc;
        $datSan->tong_tien = $tongTien;
        $datSan->save();
        return redirect()->route('ten.route.cua.ban');
    }

    private function tinhTongTien($tg_bat_dau, $tg_ket_thuc, $giaThue)
    {
        $phuThu = 0;
        $gia30p = $giaThue->gia_30p;
        $gia1h = $giaThue->gia_1h;

        $gioKetThuc = (int) date('H', strtotime($tg_ket_thuc));
        if ($gioKetThuc >= 18) {
            $phuThu = $giaThue->phu_thu_toi;
        }

        $thoiDiemBatDau = strtotime($tg_bat_dau);
        $thoiDiemKetThuc = strtotime($tg_ket_thuc);
        $soPhut = round(($thoiDiemKetThuc - $thoiDiemBatDau) / 60);

        if ($soPhut >= 60) {
            $soGio = floor($soPhut / 60);
            $soPhutConLai = $soPhut % 60;
            $tongTien = $soGio * $gia1h + $soPhutConLai * $gia30p + $phuThu;
        } else {
            $tongTien = $soPhut * $gia30p + $phuThu;
        }

        return $tongTien;
    }
    public function Search(Request $request)
    {
        $query = $request->input('query');

        $dsSanBong = SanBong::where('san_bong.ten_san', 'LIKE', "%$query%")
        ->get();


        return view('user/dat-san/hien-thi', compact('dsSanBong'));
    } 
}