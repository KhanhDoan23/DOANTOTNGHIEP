<?php

namespace App\Http\Controllers;

use App\Models\ThanhToan;
use App\Models\QuanLyDatSan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ThanhToanController extends Controller
{
    public function DanhSach(Request $request)
    {
        $Page = $request->input('Page', 5);
        $cacLanThanhToan = ThanhToan::paginate($Page);
        $dsDatSan = QuanLyDatSan::with('thanhToan')->get();
        return view('admin.thanh-toan.danh-sach', compact('cacLanThanhToan', 'dsDatSan', 'Page'));
    }
    public function ThayDoiThanhToan(Request $request, $id)
    {
        if (Gate::denies('quan-ly-thanh-toan')) {
            return redirect()->route('admin.index')->with('error','Bạn không có quyền truy cập vào chức năng này');
        }

        $trangthai = $request->trangthai;
        $thanhToan = ThanhToan::find($id);
        if (empty($thanhToan)) {
            return redirect()->route('admin.thanh-toan-page')->with('error', 'Hóa Đơn Không Tồn Tại');
        }

        $thanhToan->trang_thai_thanh_toan_id = $trangthai;
        if ($trangthai == 1) {
            $thanhToan->ngay_thanh_toan = now();
            $datSan = QuanLyDatSan::find($thanhToan->dat_san_id);
            if (!empty($datSan)) {
                $datSan->trang_thai_dat_san_id = 2;
                $datSan->save();
            }
             if (!empty($datSan))
            {
                $datSan->trang_thai_dat_san_id = 1;
                $datSan->save();
            }
        }

        $thanhToan->save();

        return redirect()->route('admin.thanh-toan-page')->with('thong_bao', 'Thay Đổi Trạng Thái Thành Công');
    }
    public function Search(Request $request)
    {
        if (Gate::denies('quan-ly-thanh-toan')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $query = $request->input('query');
        $Page = $request->input('Page', 5); 

        $cacLanThanhToan = ThanhToan::where('thanh_toan.ngay_thanh_toan', 'LIKE', "%$query%")
        ->leftJoin('dat_san', 'thanh_toan.dat_san_id', '=', 'dat_san.id')
        ->leftJoin('user', 'dat_san.user_id', '=', 'user.id')
        ->orWhere('user.ho_ten', 'LIKE', "%$query%")
        ->paginate($Page);
        $dsDatSan = ThanhToan::where('thanh_toan.ngay_thanh_toan', 'LIKE', "%$query%")
        ->leftJoin('dat_san', 'thanh_toan.dat_san_id', '=', 'dat_san.id')
        ->leftJoin('user', 'dat_san.user_id', '=', 'user.id')
        ->orWhere('user.ho_ten', 'LIKE', "%$query%")
        ->paginate($Page);


        return view('admin.thanh-toan.danh-sach', compact('cacLanThanhToan','Page','dsDatSan'));
    } 
}
