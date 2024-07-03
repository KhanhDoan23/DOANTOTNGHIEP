<?php

use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\DangNhapUserController;
use App\Http\Controllers\QuanLyDatSanController;
use App\Http\Controllers\QuanLyUser;
use App\Http\Controllers\QuanLySanBongController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\QuanLyAdminController;
use App\Models\SanBong;
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
    Route::get('/quan-ly-san-bong/danh-sach',[QuanLySanBongController::class,'DanhSach'])->name('admin.danh-sach-san-bong');
    //quản lí đặt sân
    Route::get('/quan-ly-dat-san/danh-sach',[QuanLyDatSanController::class,'DanhSach'])->name('admin.danhsach');
    //quản lí tài khoản
    Route::get('/quan-ly-tai-khoan/quan-ly-user',[QuanLyUser::class,'DanhSachKhachHang'])->name('admin.quan-ly-user');
    Route::get('/quan-ly-tai-khoan/thanhvien/them-moi', [QuanLyAdminController::class, 'ThemMoiAdmin'])->name('them-moi');
    Route::post('/quan-ly-tai-khoan/thanhvien/them-moi', [QuanLyAdminController::class, 'XuLyThemMoiAdmin'])->name('xl-them-moi');
    Route::get('/quan-ly-tai-khoan/thanhvien/danh-sach', [QuanLyAdminController::class, 'DanhSachAdmin'])->name('danh-sach');
    Route::get('/quan-ly-tai-khoan/thanhvien/cap-nhat/{id}', [QuanLyAdminController::class, 'CapNhatAdmin'])->name('cap-nhat');
    Route::post('/quan-ly-tai-khoan/thanhvien/cap-nhat/{id}', [QuanLyAdminController::class, 'XuLyCapNhatAdmin'])->name('xl-cap-nhat');

    Route::get('/quan-ly-tai-khoan/thanhvien/xoa/{id}', [QuanLyAdminController::class, 'XoaAdmin'])->name('xoa');
    Route::get('search', [QuanLyAdminController::class, 'Search'])->name('search');
    //quản lí sân bóng
    Route::get('san-bong', [SanBong::class, 'DanhSach'])->name('quan-li-san-bong.danh-sach');
    Route::get('san-bong/them-moi', [SanBong::class, 'ThemMoi'])->name('quan-li-san-bong.them-moi');
    Route::post('san-bong/them-moi', [SanBong::class, 'XuLyThemMoi'])->name('quan-li-san-bong.xu-ly-them-moi');
    Route::get('san-bong/cap-nhat/{id}', [SanBong::class, 'CapNhat'])->name('quan-li-san-bong.cap-nhat');
    Route::post('san-bong/cap-nhat/{id}', [SanBong::class, 'XuLyCapNhat'])->name('quan-li-san-bong.xu-ly-cap-nhat');
    
    Route::get('san-bong/xoa/{id}', [SanBong::class, 'Xoa'])->name('quan-li-san-bong.xoa');
});
//User
Route::group(['prefix' => 'user'],function(){
    Route::get('/dang-nhap',[DangNhapUserController::class,'dangnhapuser'])->name('user.dang-nhap');
    Route::get('/dang-xuat',[DangNhapUserController::class,'logout'])->name('user.dang-xuat');
    Route::get('/verify-account/{email}',[DangNhapUserController::class,'verify'])->name('user.verify');
    Route::post('/dang-nhap',[DangNhapUserController::class,'check_login'])->name('user.check_login');

    Route::get('/dang-ky',[DangNhapUserController::class,'dangky'])->name('user.dang-ky');
    Route::post('/dang-ky',[DangNhapUserController::class,'check_dangky']);

    Route::get('/profile',[DangNhapUserController::class,'profile'])->name('user.profile')->middleware('customer');
    Route::post('/profile',[DangNhapUserController::class,'check_profile'])->name('user.check-profile')->middleware('customer');

    Route::get('/change-pass',[DangNhapUserController::class,'change_pass'])->name('user.change-pass')->middleware('customer');
    Route::post('/change-pass',[DangNhapUserController::class,'check_change_pass'])->middleware('customer');

    Route::get('/forgot-pass',[DangNhapUserController::class,'forgot_pass'])->name('user.forgot-pass');
    Route::post('/forgot-pass',[DangNhapUserController::class,'check_forgot_pass']);

    Route::get('/reset-pass',[DangNhapUserController::class,'reset_pass'])->name('user.reset-pass');
    Route::post('/reset-pass',[DangNhapUserController::class,'check_reset_pass']);
});
Route::get('user/index',[DangNhapUserController::class,'giaodienuser'])->name('user.index');

