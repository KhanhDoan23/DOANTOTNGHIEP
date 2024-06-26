<?php

use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\DangNhapUserController;
use App\Http\Controllers\QuanLyDatSanController;
use App\Http\Controllers\UserController;
use App\Models\User;
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
Route::get('user/index',[UserController::class,'giaodienuser']);
Route::get('user/dang-nhap',[DangNhapUserController::class,'dangnhapuser'])->name('user.dang-nhap');
Route::get('user/dang-ky',[DangNhapUserController::class,'dangky'])->name('user.dang-ky');
Route::get('/admin/quan-ly-dat-san/danh-sach',[QuanLyDatSanController::class,'DanhSach'])->name('admin.danhsachdatsan');