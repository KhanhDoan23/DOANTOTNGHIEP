<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Gate;
class QuanLyUser extends Controller
{
    public function DanhSachKhachHang(Request $request){
        $Page = $request->input('Page', 5 );
        $dsKhachHang = KhachHang::paginate($Page);
        return view('admin/quan-ly-tai-khoan/quan-ly-user',compact('dsKhachHang','Page'));
    }

    public function XoaTaiKhoan($id){
        if (Gate::denies('quan-ly-tai-khoan-nguoi-dung')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $KhachHang = KhachHang::find($id);
        $KhachHang->delete();  
        return redirect()->route('admin.quan-ly-user')->with('thong_bao','Xóa Thành Công');
    }

    public function ChiTietKhachHang($id){
        if (Gate::denies('quan-ly-tai-khoan-nguoi-dung')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $KhachHang = KhachHang::find($id);
        return view('admin/quan-ly-tai-khoan/chi-tiet-tai-khoan',compact('KhachHang'));
    }

    public function Search(Request $request)
    {
        if (Gate::denies('quan-ly-tai-khoan-nguoi-dung')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $query = $request->input('query');
        $Page = $request->input('Page', 5); 
        $dsKhachHang = KhachHang::where('ho_ten', 'LIKE', "%$query%")
        ->orWhere('so_dien_thoai', 'LIKE', "%$query%")
        ->orWhere('email', 'LIKE', "%$query%")
        ->paginate($Page);

        return view('admin/quan-ly-tai-khoan/quan-ly-user', compact('dsKhachHang','Page'));
    }

}
