<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuanLyUser extends Controller
{
    public function DanhSachKhachHang()
    {
        return view('admin/quan-ly-tai-khoan/quan-ly-user');
    }
}
