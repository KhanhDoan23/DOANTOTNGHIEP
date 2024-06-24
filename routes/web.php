<?php

use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\QuanLyDatSanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/admin/dang-nhap',[DangNhapController::class,'DangNhap'])->name('admin.dang-nhap');
Route::get('/index',[DangNhapController::class,'index']);
Route::get('/admin/quan-ly-dat-san/danh-sach',[QuanLyDatSanController::class,'DanhSach'])->name('admin.danhsachdatsan');