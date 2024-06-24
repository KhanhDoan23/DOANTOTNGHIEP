<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuanLyDatSanController extends Controller
{
    public function DanhSach()
    {
        return view('admin/quan-ly-dat-san/danh-sach');
    }
}
