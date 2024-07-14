<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DangNhapController extends Controller
{
    public function index(){
        return view('admin/index');
    }
    public function DangNhap(){
        return view('admin/dang-nhap');
    }
    public function XuLyDangNhap(Request $request){
        $request->validate([
            'ten_dang_nhap' => 'required|exists:admin',
            'password'=>'required'
        ]);
        if(!isset($request->ten_dang_nhap) || empty($request->ten_dang_nhap)) {
            return redirect()->route('admin.dang-nhap')->with('message','vui lòng nhập tên');
        }

        if(!isset($request->password) || empty($request->password)) {
            return redirect()->route('admin.dang-nhap')->with('message','vui lòng nhập password');
        }

        if(Auth::attempt(['ten_dang_nhap'=> $request->ten_dang_nhap,'password'=>$request->password])){
            return redirect()->route('admin.thong-ke-san')->with('thong_bao','Đăng Nhập Thành Công');
        }
       return  redirect()->route('admin.dang-nhap')->with('message','Tên đăng nhập hoặc mật khẩu không đúng');
    }
    public function DangXuat()
    {
        auth()->logout();
        return  redirect()->route('admin.dang-nhap')->with('thong_bao','Đăng Xuất Thành Công');
    }
}
