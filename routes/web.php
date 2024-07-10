
<?php
use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\DangNhapUserController;
use App\Http\Controllers\DatSanController;
use App\Http\Controllers\LichSuDatSanController;
use App\Http\Controllers\LienHeController;
use App\Http\Controllers\QuanLyDatSanController;
use App\Http\Controllers\QuanLyUser;
use App\Http\Controllers\QuanLySanBongController;
use App\Http\Controllers\UserController;

use App\Models\SanBong;
use App\Http\Controllers\TinTucController;
use App\Models\User;
use App\Http\Controllers\QuanLyAdminController;
use App\Http\Controllers\ThanhToanController;
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

Route::post('admin/dang-nhap', [DangNhapController::class, 'XuLyDangNhap']);
Route::get('user/index',[DangNhapUserController::class,'giaodienuser'])->name('user.index');


Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){
    Route::get('/index',[DangNhapController::class,'index'])->name('admin.index');
    Route::get('/dang-xuat', [DangNhapController::class, 'DangXuat'])->name('admin.dang-xuat');

    //quản lí tài khoản
    Route::get('/quan-ly-tai-khoan/quan-ly-user',[QuanLyUser::class,'DanhSachKhachHang'])->name('admin.quan-ly-user');
    Route::get('/quan-ly-dat-san/danh-sach',[QuanLyDatSanController::class,'DanhSach'])->name('admin.danhsach');
    
    Route::get('/quan-ly-tai-khoan/thanhvien/them-moi', [QuanLyAdminController::class, 'ThemMoiAdmin'])->name('them-moi');
    Route::post('/quan-ly-tai-khoan/thanhvien/them-moi', [QuanLyAdminController::class, 'XuLyThemMoiAdmin'])->name('xl-them-moi');
    Route::get('/quan-ly-tai-khoan/thanhvien/danh-sach', [QuanLyAdminController::class, 'DanhSachAdmin'])->name('danh-sach');
    Route::get('/quan-ly-tai-khoan/thanhvien/cap-nhat/{id}', [QuanLyAdminController::class, 'CapNhatAdmin'])->name('cap-nhat');
    Route::post('/quan-ly-tai-khoan/thanhvien/cap-nhat/{id}', [QuanLyAdminController::class, 'XuLyCapNhatAdmin'])->name('xl-cap-nhat');

    Route::get('/quan-ly-tai-khoan/thanhvien/xoa/{id}', [QuanLyAdminController::class, 'XoaAdmin'])->name('xoa');
    Route::get('search', [QuanLyAdminController::class, 'Search'])->name('search');
    //quản lí sân bóng
    Route::get('quan-ly-san-bong/danh-sach', [QuanLySanBongController::class, 'DanhSach'])->name('admin.quan-li-san-bong.danh-sach');
    Route::get('quan-ly-san-bong/them-moi', [QuanLySanBongController::class, 'ThemMoi'])->name('admin.quan-ly-san-bong.them-moi');
    Route::post('quan-ly-san-bong/them-moi', [QuanLySanBongController::class, 'XuLyThemMoi'])->name('quan-li-san-bong.xu-ly-them-moi');
    Route::get('quan-ly-san-bong/cap-nhat/{id}', [QuanLySanBongController::class, 'CapNhat'])->name('quan-li-san-bong.cap-nhat');
    Route::post('quan-ly-san-bong/cap-nhat/{id}', [QuanLySanBongController::class, 'XuLyCapNhat'])->name('quan-li-san-bong.xu-ly-cap-nhat');
    Route::get('quan-ly-san-bong/xoa/{id}', [QuanLySanBongController::class, 'Xoa'])->name('admin.quan-li-san-bong.xoa');
    Route::get('/quan-ly-san-bong/search', [QuanLySanBongController::class, 'Search'])->name('admin.quan-ly-san-bong.search');

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

    Route::get('/change-pass',[DangNhapUserController::class,'change_pass'])->name('user.change-pass')->middleware('customer');
    Route::post('/change-pass',[DangNhapUserController::class,'check_change_pass'])->middleware('customer');

    Route::get('/forgot-pass',[DangNhapUserController::class,'forgot_pass'])->name('user.forgot-pass');
    Route::post('/forgot-pass',[DangNhapUserController::class,'check_forgot_pass']);

    Route::get('/reset-pass/{token}',[DangNhapUserController::class,'reset_pass'])->name('user.reset-pass');
    Route::post('/reset-pass/{token}',[DangNhapUserController::class,'check_reset_pass']);
});
Route::get('user/index',[DangNhapUserController::class,'giaodienuser'])->name('user.index');
Route::get('/tin-tuc/hien-thi', [TinTucController::class, 'HienThi'])->name('user.tin-tuc.hien-thi');
Route::get('/tin-tuc/chi-tiet/{id}', [TinTucController::class, 'ChiTietHienThi'])->name('user.tin-tuc.chi-tiet');


Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){
    Route::get('/tin-tuc/danh-sach', [TinTucController::class, 'DanhSach'])->name('tin-tuc.danh-sach');
    Route::get('/tin-tuc/them-moi', [TinTucController::class, 'ThemMoi'])->name('tin-tuc.them-moi');
    Route::post('/tin-tuc/xl-them-moi', [TinTucController::class, 'XuLyThemMoi'])->name('tin-tuc.xl-them-moi');
    Route::get('/tin-tuc/chi-tiet/{id}', [TinTucController::class, 'ChiTiet'])->name('tin-tuc.chi-tiet');
    Route::get('/tin-tuc/cap-nhat/{id}', [TinTucController::class, 'CapNhat'])->name('tin-tuc.cap-nhat');
    Route::put('/tin-tuc/xl-cap-nhat/{id}', [TinTucController::class, 'XuLyCapNhat'])->name('tin-tuc.xl-cap-nhat');
    Route::delete('/tin-tuc/{id}', [TinTucController::class, 'Xoa'])->name('tin-tuc.xoa');
    Route::get('/tin-tuc/search', [TinTucController::class, 'Search'])->name('admin.tin-tuc.search');
});

//Đăt sân
Route::group(['prefix' => 'admin','middleware' => 'auth'],function(){
    Route::get('/quan-ly-dat-san/danh-sach',[QuanLyDatSanController::class,'DanhSach'])->name('admin.danhsach');
    Route::put('/quan-ly-dat-san/{id}/thay-doi-trang-thai', [QuanLyDatSanController::class, 'ThayDoiTrangThaiDon'])->name('admin.thay-doi-trang-thai');
    Route::put('/quan-ly-dat-san/{id}/thay-doi', [ThanhToanController::class, 'ThayDoiThanhToan'])->name('admin.thay-doi-trang-thai-thanh-toan');
    Route::get('/quan-ly-dat-san/search', [QuanLyDatSanController::class, 'Search'])->name('admin.quan-ly-dat-san.search');
    Route::get('/thanh-toan/danh-sach', [ThanhToanController::class, 'DanhSach'])->name('admin.thanh-toan-page');
    Route::get('/thanh-toan/search', [ThanhToanController::class, 'Search'])->name('admin.thanh-toan.search');
    Route::get('/thong-ke/thong-ke', [ThanhToanController::class, 'ThongKeDoanhThu'])->name('admin.thong-ke');
});


Route::get('/dat-san/hien-thi', [QuanLyDatSanController::class, 'HienThi'])->name('user.dat-san.hien-thi');
Route::get('/dat-san/search', [DatSanController::class, 'Search'])->name('user.dat-san.search');
Route::get('user/dat-san/chon-thoi-gian/{id}', [QuanLyDatSanController::class, 'ChonThoiGian'])->name('dat-san.show');
Route::post('user/dat-san/store/{id}', [QuanLyDatSanController::class, 'store'])->name('dat-san.store');

//Lịch sử đặt
Route::get('user/lich-su-dat/lich-su', [LichSuDatSanController::class, 'DanhSach'])->name('lich-su-dat-san');
Route::put('user/lich-su-dat/huy/{id}', [LichSuDatSanController::class, 'huyDatSan'])->name('user.huy-dat-san');

Route::get('user/lien-he/lien-he', [LienHeController::class, 'ChamSocKhachHang'])->name('lien-he-ho-tro');



