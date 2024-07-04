<?php

use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\DangNhapUserController;
use App\Http\Controllers\QuanLyDatSanController;
use App\Http\Controllers\QuanLyUser;
use App\Http\Controllers\TinTucController;
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
Route::post('admin/dang-nhap', [DangNhapController::class, 'XuLyDangNhap']);
Route::get('user/index',[DangNhapUserController::class,'giaodienuser'])->name('user.index');

Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){
    Route::get('/index',[DangNhapController::class,'index'])->name('admin.index');
    Route::get('/dang-xuat', [DangNhapController::class, 'DangXuat'])->name('admin.dang-xuat');
    Route::get('/quan-ly-dat-san/danh-sach',[QuanLyDatSanController::class,'DanhSach'])->name('admin.danhsach');
    
    Route::get('/quan-ly-tai-khoan/thanhvien/them-moi', [QuanLyAdminController::class, 'ThemMoiAdmin'])->name('them-moi');
    Route::post('/quan-ly-tai-khoan/thanhvien/them-moi', [QuanLyAdminController::class, 'XuLyThemMoiAdmin'])->name('xl-them-moi');
    Route::get('/quan-ly-tai-khoan/thanhvien/danh-sach', [QuanLyAdminController::class, 'DanhSachAdmin'])->name('danh-sach');
    Route::get('/quan-ly-tai-khoan/thanhvien/cap-nhat/{id}', [QuanLyAdminController::class, 'CapNhatAdmin'])->name('cap-nhat');
    Route::post('/quan-ly-tai-khoan/thanhvien/cap-nhat/{id}', [QuanLyAdminController::class, 'XuLyCapNhatAdmin'])->name('xl-cap-nhat');
    Route::get('/quan-ly-tai-khoan/thanhvien/xoa/{id}', [QuanLyAdminController::class, 'XoaAdmin'])->name('xoa');
    Route::get('search', [QuanLyAdminController::class, 'Search'])->name('admin.search');

    //Quản lý khách hàng
    Route::get('/quan-ly-tai-khoan/quan-ly-user',[QuanLyUser::class,'DanhSachKhachHang'])->name('admin.quan-ly-user');
    Route::get('/quan-ly-tai-khoan/xoa/{id}',[QuanLyUser::class,'XoaTaiKhoan'])->name('admin.xoa');
    Route::get('/quan-ly-tai-khoan/chi-tiet/{id}',[QuanLyUser::class,'ChiTietKhachHang'])->name('admin.chi-tiet');
    // Route::get('search', [QuanLyUser::class, 'Search'])->name('admin.search');

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

    Route::get('/tin-tuc/hien-thi', [TinTucController::class, 'HienThi'])->name('user.tin-tuc.hien-thi');
    Route::get('/tin-tuc/chi-tiet/{id}', [TinTucController::class, 'ChiTietHienThi'])->name('user.tin-tuc.chi-tiet');
    // Route::get('/change-pass',[DangNhapUserController::class,'change_pass'])->name('user.change-pass')->middleware('customer');
    // Route::post('/change-pass',[DangNhapUserController::class,'check_change_pass'])->middleware('customer');

    // Route::get('/forgot-pass',[DangNhapUserController::class,'forgot_pass'])->name('user.forgot-pass');
    // Route::post('/forgot-pass',[DangNhapUserController::class,'check_forgot_pass']);

    // Route::get('/reset-pass',[DangNhapUserController::class,'reset_pass'])->name('user.reset-pass');
    // Route::post('/reset-pass',[DangNhapUserController::class,'check_reset_pass']);
});

Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){
    Route::get('/tin-tuc/danh-sach', [TinTucController::class, 'DanhSach'])->name('tin-tuc.danh-sach');
    Route::get('/tin-tuc/them-moi', [TinTucController::class, 'ThemMoi'])->name('tin-tuc.them-moi');
    Route::post('/tin-tuc/xl-them-moi', [TinTucController::class, 'XuLyThemMoi'])->name('tin-tuc.xl-them-moi');
    Route::get('/tin-tuc/chi-tiet/{id}', [TinTucController::class, 'ChiTiet'])->name('tin-tuc.chi-tiet');
    Route::get('/tin-tuc/cap-nhat/{id}', [TinTucController::class, 'CapNhat'])->name('tin-tuc.cap-nhat');
    Route::put('/tin-tuc/xl-cap-nhat/{id}', [TinTucController::class, 'XuLyCapNhat'])->name('tin-tuc.xl-cap-nhat');
    Route::delete('/tin-tuc/{id}', [TinTucController::class, 'Xoa'])->name('tin-tuc.xoa');
});