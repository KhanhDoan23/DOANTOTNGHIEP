<?php

namespace App\Http\Controllers;

use App\Models\GiaThue;
use Illuminate\Http\Request;
use App\Models\SanBong;
use App\Models\LoaiSan;
use Illuminate\Support\Facades\Gate;
class QuanLySanBongController extends Controller
{
    public function DanhSach(Request $request)
    {
        $Page = $request->input('Page', 5 );
        $dsSanBong=SanBong::paginate($Page);
        return view('admin/quan-ly-san-bong/danh-sach',compact('dsSanBong','Page'));
    }
    public function ThemMoi()
    {
        if (Gate::denies('quan-ly-dat-san')) {
            return redirect()->route('admin.index')->with('error','Bạn không có quyền truy cập vào chức năng này');
        }
        $dsSanBong=SanBong::all();
        $dsLoaiSan = LoaiSan::all();
        return view('admin/quan-ly-san-bong/them-moi', compact('dsLoaiSan','dsSanBong'));
    }
    
    
    public function XuLyThemMoi(Request $request)
    {
        $sanbong = new SanBong();
        $validatedData = $request->validate([
            'ten_san' => 'required|unique:san_bong,ten_san',
        ],[
            'ten_san.required' => 'Tên sân không được để trống',
            'ten_san.unique' => 'Tên sân đã tồn tại',
        ]);
        $sanbong = new SanBong();
        $sanbong->ten_san=$request->ten_san;
        $sanbong->dia_chi=$request->dia_chi;
        $sanbong->loai_san_id=$request->loai_san;
        $sanbong->gia_thue_id= 1;
        if ($request->hasFile('hinh_anh')) {
            $image = $request->file('hinh_anh');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $sanbong->hinh_anh = 'images/'.$imageName;
        }
            $sanbong->save();
            return redirect()->route('admin.quan-li-san-bong.danh-sach')->with('thong_bao', 'Thêm sân mới thành công');
    }
    
    public function CapNhat($id)
    {
        if (Gate::denies('quan-ly-dat-san')) {
            return redirect()->route('admin.index')->with('error','Bạn không có quyền truy cập vào chức năng này');
        }
        $sanbong=SanBong::find($id);
        $loaisan=LoaiSan::all();
        return view('admin/quan-ly-san-bong/cap-nhat',compact('sanbong','loaisan'));
    }

    public function XuLyCapNhat(Request $request, $id)
    {
        $sanbong=SanBong::findOrFail($id);
        $validatedData = $request->validate([
            'ten_san' => 'required',
        ],[
            'ten_san.required' => 'Tên sân không được để trống',
        ]);   
        $sanbong->ten_san=$request->ten_san;
        $sanbong->dia_chi=$request->dia_chi;
        $sanbong->loai_san_id=$request->loai_san;
        $sanbong->gia_thue_id= 1;
        if ($request->hasFile('hinh_anh')) {
            $image = $request->file('hinh_anh');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $sanbong->hinh_anh = 'images/'.$imageName;
        }
        $sanbong->save();
        return redirect()->route('admin.quan-li-san-bong.danh-sach')->with('thong_bao', 'Cập nhật sân bóng thành công');
    }

    public function Xoa($id)
    {
        if (Gate::denies('quan-ly-dat-san')) {
            return redirect()->route('admin.index')->with('error','Bạn không có quyền truy cập vào chức năng này');
        }
        $sanbong = SanBong::find($id);       
        $sanbong->delete();
        return redirect()->route('admin.quan-li-san-bong.danh-sach')->with('thong_bao', 'Xoá thành công');
    }
    public function Search(Request $request)
    {
        if (Gate::denies('quan-ly-dat-san')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $query = $request->input('query');
        $Page = $request->input('Page', 5); 

        $dsSanBong = SanBong::where('san_bong.ten_san', 'LIKE', "%$query%")
        ->paginate($Page);


        return view('admin/quan-ly-san-bong/danh-sach', compact('dsSanBong','Page'));
    } 
    
}
