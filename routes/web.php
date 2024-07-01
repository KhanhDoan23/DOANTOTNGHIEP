<?php

use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\DangNhapUserController;
use App\Http\Controllers\QuanLyDatSanController;
use App\Http\Controllers\QuanLyUser;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\QuanLyAdminController;
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
    return view('user/index');
});

//Admin
Route::get('admin/dang-nhap', [DangNhapController::class, 'DangNhap'])->name('admin.dang-nhap');
Route::post('admin/dang-nhap', [DangNhapController::class, 'XuLyDangNhap'])->name('admin.dang-nhap');

Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){
    Route::get('/index',[DangNhapController::class,'index'])->name('admin.index');
    Route::get('/dang-xuat', [DangNhapController::class, 'DangXuat'])->name('admin.dang-xuat');
    Route::get('/quan-ly-dat-san/danh-sach',[QuanLyDatSanController::class,'DanhSach'])->name('admin.danhsach');
    Route::get('/quan-ly-tai-khoan/quan-ly-user',[QuanLyUser::class,'DanhSachKhachHang'])->name('admin.quan-ly-user');
    Route::get('/quan-ly-tai-khoan/thanhvien/them-moi', [QuanLyAdminController::class, 'ThemMoiAdmin'])->name('them-moi');
    Route::post('/quan-ly-tai-khoan/thanhvien/them-moi', [QuanLyAdminController::class, 'XuLyThemMoiAdmin'])->name('xl-them-moi');
    Route::get('/quan-ly-tai-khoan/thanhvien/danh-sach', [QuanLyAdminController::class, 'DanhSachAdmin'])->name('danh-sach');
    Route::get('/quan-ly-tai-khoan/thanhvien/cap-nhat/{id}', [QuanLyAdminController::class, 'CapNhatAdmin'])->name('cap-nhat');
    Route::post('/quan-ly-tai-khoan/thanhvien/cap-nhat/{id}', [QuanLyAdminController::class, 'XuLyCapNhatAdmin'])->name('xl-cap-nhat');
    Route::get('/quan-ly-tai-khoan/thanhvien/xoa/{id}', [QuanLyAdminController::class, 'XoaAdmin'])->name('xoa');
    Route::get('search', [QuanLyAdminController::class, 'Search'])->name('search');
});

Route::get('user/index',[UserController::class,'giaodienuser']);
Route::get('user/dang-nhap',[DangNhapUserController::class,'dangnhapuser'])->name('user.dang-nhap');
Route::get('user/dang-ky',[DangNhapUserController::class,'dangky'])->name('user.dang-ky');
