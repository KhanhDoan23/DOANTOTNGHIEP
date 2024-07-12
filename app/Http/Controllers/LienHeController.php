<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DangNhap;
class LienHeController extends Controller
{
    public function ChamSocKhachHang(Request $request){
        $dsAdmin = DangNhap::where('quyen_id', 6)->first();
        if(empty( $dsAdmin))
        {
            return redirect()->back()->with('error', 'Tính Năng Này Tạm Thời Chưa Có Nhân Viên Hỗ Trợ Nếu Cần Thiết Liên Hệ Hotline Trực Tiếp Đầu Trang');
        }
        return view('user/lien-he/lien-he',compact('dsAdmin'));
    }
}
