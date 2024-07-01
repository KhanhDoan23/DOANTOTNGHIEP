<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DangNhap;
use App\Models\Quyen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AdminRequest;

class QuanLyAdminController extends Controller
{
    public function ThemMoiAdmin(){
        if (Gate::denies('quan-ly-tai-khoan-admin')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $dsQuyen = Quyen::all();
        return view('admin/quan-ly-tai-khoan/thanhvien/them-moi', compact('dsQuyen'));
    }

    public function XuLyThemMoiAdmin(AdminRequest $request){
      
        $admin= new DangNhap();
        $admin->ten           = $request->ten;
        $admin->ten_dang_nhap = $request->ten_dang_nhap;
        $admin->password      = Hash::make($request->password);
        $admin->quyen_id      = $request->quyen;
        $admin->save();

        return redirect()->route('danh-sach')->with('thong_bao','thêm tài khoản quản lý thành công');
    }

    public function DanhSachAdmin(Request $request){
        $Page = $request->input('Page', 5 );
        $dsAdmin = DangNhap::paginate($Page);
        return view('admin/quan-ly-tai-khoan/thanhvien/danh-sach',compact('dsAdmin','Page'));
    }

    public function XoaAdmin($id)
    {
        if (Gate::denies('quan-ly-tai-khoan-admin')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $admin = DangNhap::find($id);
        if(empty($admin))
        {
            return redirect()->route('danh-sach')->with('error','tài khoản không tồn tại');
        }
        $admin->delete();
        return redirect()->route('danh-sach')->with('thong_bao','Xóa Thành Công');

    }

    public function CapNhatAdmin($id){
        if (Gate::denies('quan-ly-tai-khoan-admin')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $admin = DangNhap::find($id);
        $quyen = Quyen::all();
        return view('admin/quan-ly-tai-khoan/thanhvien/cap-nhat',compact('admin','quyen'));
    }

    public function XuLyCapNhatAdmin(AdminRequest $request, $id)
    {
        $admin = DangNhap::find($id);
        if (empty($admin)) {
            return redirect()->route('danh-sach')->with('error','tài khoản không tồn tại');
        }
        $admin->ten     = $request->ten;
        $admin->ten_dang_nhap    = $request->ten_dang_nhap;
        if($request->password != $admin->password ){
            $admin->password     = Hash::make($request->password);
        }
        $admin->quyen_id = $request->quyen;
        $admin->save();
        

        return redirect()->route('danh-sach')->with('thong_bao','Cập Nhật Tài Khoản Thành Công');
     
    }

    public function Search(Request $request)
    {
        if (Gate::denies('quan-ly-tai-khoan-admin')) {
            return redirect()->route('admin.index')->with('error','bạn không có quyền truy cập vào chức năng này');
        }
        $query = $request->input('query');
        $Page = $request->input('Page', 5); 

        $dsAdmin = DangNhap::where('admin.ten', 'LIKE', "%$query%")
        ->orWhere('admin.ten_dang_nhap', 'LIKE', "%$query%")
        ->leftJoin('quyen', 'admin.quyen_id', '=', 'quyen.id')
        ->orWhere('quyen.ten_quyen', 'LIKE', "%$query%")
        ->paginate($Page);


        return view('admin/quan-ly-tai-khoan/thanhvien/danh-sach', compact('dsAdmin','Page'));
    } 

}
