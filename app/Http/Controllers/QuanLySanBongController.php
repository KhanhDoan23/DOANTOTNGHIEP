<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanBong;
use App\Models\LoaiSan;
class QuanLySanBongController extends Controller
{
    public function DanhSach()
    {
        $dsSanBong=SanBong::all();
        return view('admin.quan-ly-san-bong.danh-sach',compact('dsSanBong'));
    }
    public function ThemMoi()
    {
        $dsSanBong=SanBong::all();
        $dsLoaiSan=LoaiSan::all();
        return view('admin.quan-li-san-bong.danh-sach',compact('dsSanBong'));
    }
    
    public function XuLyThemMoi(Request $request)
    {
        $sanbong = new SanBong();
        $validatedData = $request->validate([
            'ten_san' => 'required',
        ]);
        $existingSanBong = SanBong::where('ten_san', $request->ten_san)->first();
        if ($existingSanBong) {
            return view('admin.quan-li-san_bong.them-moi')->with('error', 'Tên sân đã tồn tại');
        }
        $sanbong = new SanBong();
        $sanbong->ten_san=$request->ten_san;
        $sanbong->loai_san_id=$request->loai_san;
        $sanbong->loai_san_id=$request->hinh_anh;

        try {
            $sanbong->save();
            return redirect()->route('admin.quan-li-san_bong.danh-sach')->with('success', 'Thêm nhà cung cấp mới thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }
    
    public function CapNhat($id)
    {
        $sanbong=SanBong::find($id);
        return view('quan-li-san-bong.cap-nhat ',compact('sanbong'));
    }

    public function XuLyCapNhat(Request $request, $id)
    {
        $sanbong=SanBong::find($id);
        $validatedData = $request->validate([
            'ten_san' => 'required',
        ]);   
        $sanbong->ten_san=$request->ten_san;
        $sanbong->loai_san_id=$request->loai_san;
        $sanbong->loai_san_id=$request->hinh_anh;
        $sanbong->save();
        return redirect()->route('quan-li-san_bong.danh-sach')->with('success', 'Cập nhật sân bóng thành công');
    }

    public function Xoa($id)
    {
        $sanbong = SanBong::find($id);       
        $sanbong->delete();
        return redirect()->route('quan-li-san-bong.danh-sach');
    }
   
    
}
