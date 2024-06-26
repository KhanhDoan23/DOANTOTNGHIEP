<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DangNhapUserController extends Controller
{
    public function dangnhapuser()
    {
        return view("user/dang-nhap");
    }
    public function dangky()
    {
        return view("user/dang-ky");
    }
}
