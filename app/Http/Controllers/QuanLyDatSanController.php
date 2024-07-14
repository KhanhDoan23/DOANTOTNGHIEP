<?php

namespace App\Http\Controllers;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Auth;
use App\Models\QuanLyDatSan;
use App\Models\ThanhToan;
use App\Models\SanBong;
use App\Models\GiaThue;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
class QuanLyDatSanController extends Controller
{
    public function DanhSach(Request $request)
    {
        $Page = $request->input('Page', 10);
        $trangThai = $request->input('trangthai');
        $query = QuanLyDatSan::orderBy('ngay_dat', 'desc');
        if ($trangThai) {
            $query->where('trang_thai_dat_san_id', $trangThai);
        }
        $dsDatSan = $query->paginate($Page);
        foreach ($dsDatSan as $datSan) {
            $giaThue = GiaThue::findOrFail($datSan->gia_thue_id);
            $tg_bat_dau = $datSan->tg_bat_dau;
            $tg_ket_thuc = $datSan->tg_ket_thuc;
            $tongTien = $this->tinhTongTien($tg_bat_dau, $tg_ket_thuc, $giaThue);
            $datSan->tong_tien = $tongTien;
            $datSan->save();
        }

        return view('admin.quan-ly-dat-san.danh-sach', compact('dsDatSan', 'Page','trangThai'));
    }

    
    public function HienThi()
    {
        $dsSanBong = SanBong::all();
        return view('user/dat-san/hien-thi', compact('dsSanBong'));
    }
    public function ChonThoiGian($id)
    {
        if (!auth('cus')->check()) {
            return redirect()->back()->with('error', 'Vui lòng đăng nhập để tiếp tục.');
        }

        $dsSanBong = SanBong::findOrFail($id);
        $datSan=QuanLyDatSan::where('user_id', auth('cus')->user()->id)->get();
        $lichDatSan = QuanLyDatSan::where('san_bong_id', $id)->get();
        $tatCaThoiGian = $this->layTatCaThoiGian($id);
        return view('user/dat-san/chon-thoi-gian', compact('dsSanBong','datSan','lichDatSan','tatCaThoiGian'));
    }
    private function layTatCaThoiGian($id)
    {
    $lichDatSan = QuanLyDatSan::where('san_bong_id', $id)->get();
    
    $tatCaThoiGian = [];
    $gioBatDau = 7;
    $gioKetThuc = 22;
    for ($gio = $gioBatDau; $gio < $gioKetThuc; $gio++) {
        $batDau = date('Y-m-d H:i:s', strtotime("today $gio:00"));
        $ketThuc = date('Y-m-d H:i:s', strtotime("today " . ($gio + 1) . ":00"));

        $coTrungLap = false;
        foreach ($lichDatSan as $lich) {
            $tgBatDauDB = $lich->tg_bat_dau;
            $tgKetThucDB = $lich->tg_ket_thuc;
            if (!($ketThuc <= $tgBatDauDB || $batDau >= $tgKetThucDB)) {
                $coTrungLap = true;
                break;
            }
        }
        if (!$coTrungLap && !(date('H', strtotime($batDau)) >= 22 || date('H', strtotime($batDau)) < 7)) {
            $tatCaThoiGian[] = [
                'bat_dau' => $batDau,
                'ket_thuc' => $ketThuc,
            ];
        }
    }
    
    return $tatCaThoiGian;
}

    

public function store(Request $request, $id)
    {
        if (!auth('cus')->check()) {
            return redirect()->back()->with('error', 'Vui lòng đăng nhập trước khi đặt sân.');
        }
        $now = now();
        $tgBatDau = strtotime($request->tg_bat_dau);
        if ($tgBatDau < $now->timestamp) {
            return redirect()->back()->with('error', 'Không thể chọn thời gian trong quá khứ.');
        }
        $validatedData = $request->validate([
            'tg_bat_dau' => 'required|date',
            'tg_ket_thuc' => 'required|date|after:tg_bat_dau',
        ]);
        $dsSanBong = SanBong::findOrFail($id);
        $gia_thue_id = $dsSanBong->gia_thue_id;
        $giaThue = GiaThue::findOrFail($gia_thue_id);
        $tongTien = $this->tinhTongTien($request->tg_bat_dau, $request->tg_ket_thuc, $giaThue);

        $gioBatDau = date('H', strtotime($request->tg_bat_dau));
        if ($gioBatDau >= 22 || $gioBatDau < 7) {
            return redirect()->back()->with('error', 'Không thể đặt sân vào thời gian từ 22h đến 7h sáng.');
        }
        $lichDatSan = QuanLyDatSan::where('san_bong_id', $id)
            ->where(function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('tg_bat_dau', '>=', $request->tg_bat_dau)
                        ->where('tg_bat_dau', '<', $request->tg_ket_thuc);
                })
                ->orWhere(function ($q) use ($request) {
                    $q->where('tg_ket_thuc', '>', $request->tg_bat_dau)
                        ->where('tg_ket_thuc', '<=', $request->tg_ket_thuc);
                });
            })
            ->exists();

        if ($lichDatSan) {
            return redirect()->back()->with('error', 'Thời gian này đã có người đặt sân. Vui lòng chọn thời gian khác.');
        }
        $datSan = new QuanLyDatSan();
        $datSan->san_bong_id = $dsSanBong->id;
        $datSan->user_id = auth('cus')->user()->id;
        $datSan->ngay_dat = now();
        $datSan->gia_thue_id = $gia_thue_id;
        $datSan->tg_bat_dau = $request->tg_bat_dau;
        $datSan->tg_ket_thuc = $request->tg_ket_thuc;
        $datSan->tong_tien = $tongTien;
        $datSan->trang_thai_thanh_toan_id = 2;
        $datSan->trang_thai_dat_san_id = 4;
        $datSan->save();
        $thanhToan = new ThanhToan();
        $thanhToan->dat_san_id = $datSan->id;
        $thanhToan->gia_thue_id = $gia_thue_id;
        $thanhToan->ngay_thanh_toan = null;
        $thanhToan->trang_thai_thanh_toan_id = 2;
        $thanhToan->save();

        return redirect()->route('user.dat-san.hien-thi')->with('thong_bao', 'Đặt sân thành công');
    }
    private function tinhTongTien($tg_bat_dau, $tg_ket_thuc, $gia_thue)
    {
        if (!$gia_thue) {
            return 0;
        }
    
        $phuThu = 0;
        $gia30p = $gia_thue->gia_30p;
        $gia1h = $gia_thue->gia_1h;
    
        $gioKetThuc = (int) date('H', strtotime($tg_ket_thuc));
        if ($gioKetThuc >= 18) {
            $phuThu = $gia_thue->phu_thu_toi;
        }
    
        $thoiDiemBatDau = strtotime($tg_bat_dau);
        $thoiDiemKetThuc = strtotime($tg_ket_thuc);
        $soPhut = round(($thoiDiemKetThuc - $thoiDiemBatDau) / 60);
    
        if ($soPhut >= 60) {
            $soGio = floor($soPhut / 60);
            $soPhutConLai = $soPhut % 60;
            if ($soPhutConLai > 30) {
                $soGio += 1; 
                $soPhutConLai = 0;
            } elseif ($soPhutConLai > 0 && $soPhutConLai <= 30) {
                $soPhutConLai = 1;
            }
    
            $tongTien = $soGio * $gia1h + $soPhutConLai * $gia30p + $phuThu;
        } elseif($soPhut < 60 && $soPhut >=1) {
            $tongTien = $gia30p + $phuThu;
        }
        else{
            $tongTien=0; 
        }
    
        return $tongTien;
    }
    

    public function ThayDoiTrangThaiDon(Request $request, $id)
    {
        if (Gate::denies('quan-ly-thanh-toan')) {
            return redirect()->route('admin.index')->with('error','Bạn không có quyền truy cập vào chức năng này');
        }
        $trangthai = $request->trangthai;

        $datSan = QuanLyDatSan::find($id);
        if (empty($datSan)) {
            return redirect()->route('admin.danhsach')->with('error', 'Lịch Đặt Sân Không Tồn Tại');
        }

        $datSan->trang_thai_dat_san_id = $trangthai;
        if ($trangthai == 1) { 
            $datSan->ngay_dat = now();
        }
        if( $trangthai==3)
        {
            $datSan->trang_thai_thanh_toan_id = 2;
        }
        
        $datSan->save();

        return redirect()->route('admin.danhsach')->with('thong_bao', 'Thay Đổi Trạng Thái Thành Công');
    }
    public function Search(Request $request)
    {
        if (Gate::denies('quan-ly-thanh-toan')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $query = $request->input('query');
        $Page = $request->input('Page', 10); 
        $trangThai = $request->input('trangthai');

        $dsDatSan = QuanLyDatSan::where('dat_san.tong_tien', 'LIKE', "%$query%")
        ->leftJoin('user', 'dat_san.user_id', '=', 'user.id')
        ->orWhere('user.ho_ten', 'LIKE', "%$query%")
        ->leftJoin('san_bong', 'dat_san.san_bong_id', '=', 'san_bong.id')
        ->orWhere('san_bong.ten_san', 'LIKE', "%$query%")
        ->paginate($Page);


        return view('admin.quan-ly-dat-san.danh-sach', compact('dsDatSan','Page','trangThai'));
    } 
    public function thongKeSan(Request $request)
    {
        if (Gate::denies('quan-ly-thanh-toan')) {
            return redirect()->route('admin.index')->with('error', 'Bạn không có quyền truy cập vào chức năng này');
        }

        $ngayThangNam = $request->input('ngay_thang_nam');
        $startDate = null;
        $endDate = null;

        if ($ngayThangNam) {
            $startDate = Carbon::createFromFormat('Y-m-d', $ngayThangNam)->startOfDay();
            $endDate = Carbon::createFromFormat('Y-m-d', $ngayThangNam)->endOfDay();
        } else {
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
            $ngayThangNam = $startDate->format('Y-m-d');
        }

        $sanDaDat = QuanLyDatSan::whereBetween('ngay_dat', [$startDate, $endDate])
            ->where('trang_thai_dat_san_id', '<>', 3)
            ->count();

        $sanDaHuy = QuanLyDatSan::whereBetween('ngay_dat', [$startDate, $endDate])
            ->where('trang_thai_dat_san_id', 3)
            ->count();

        $nguoiDatSan = QuanLyDatSan::whereBetween('ngay_dat', [$startDate, $endDate])
            ->selectRaw('count(distinct user_id) as count')
            ->first()->count;

        $userDangKy = KhachHang::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return view('admin.thong-ke.thong-ke-san', compact('sanDaDat', 'nguoiDatSan', 'sanDaHuy', 'userDangKy', 'ngayThangNam'));
    }

    
}
