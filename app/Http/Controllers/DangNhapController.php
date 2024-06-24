<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DangNhapController extends Controller
{
    public function index(){
        return view('index');
    }
    public function DangNhap(){
        return view('admin/dang-nhap');
    }
}
