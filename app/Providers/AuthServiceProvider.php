<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\DangNhap;
use App\Policies\AdminPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Admin::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::define('quan-ly-san-pham', function (DangNhap $admin) {
        //     if ($admin->quyen && $admin->quyen->ten_quyen === 'Quản Lý Sản Phẩm' ||  $admin->quyen->ten_quyen === 'Quản Lý' ) {
        //         return true;
        //     }
        //     return false;
        // });
    
        // Gate::define('quan-ly-nha-cung-cap', function (DangNhap $admin) {
        //     if ($admin->quyen && $admin->quyen->ten_quyen === 'Quản Lý Nhà Cung Cấp' || $admin->quyen->ten_quyen === 'Quản Lý') {
        //         return true;
        //     }
        //     return false;
        // });
        // Gate::define('quan-ly-hoa-don-nhap', function (DangNhap $admin) {
        //     if ($admin->quyen && $admin->quyen->ten_quyen === 'Quản Lý Hóa Đơn Nhập' || $admin->quyen->ten_quyen === 'Quản Lý') {
        //         return true;
        //     }
        //     return false;
        // });
    
        Gate::define('quan-ly-thanh-toan', function (DangNhap $admin) {
            if ($admin->quyen && $admin->quyen->ten_quyen === 'Nhân Viên Thu Ngân' ||  $admin->quyen->ten_quyen === 'Admin') {
                return true;
            }
            return false;
        });
        Gate::define('quan-ly-dat-san', function (DangNhap $admin) {
            if ($admin->quyen && $admin->quyen->ten_quyen === 'Admin' || $admin->quyen->ten_quyen === 'Nhân Viên') {
                return true;
            }
            return false;
        });
    
        Gate::define('quan-ly-tin-tuc', function (DangNhap $admin) {
            if ($admin->quyen && $admin->quyen->ten_quyen === 'Nhân Viên' ||  $admin->quyen->ten_quyen === 'Admin') {
                return true;
            }
            return false;
        });


        Gate::define('quan-ly-tai-khoan-admin', function (DangNhap $admin) {
            return $admin->quyen->ten_quyen === 'Admin';
        });
    
        Gate::define('quan-ly-tai-khoan-nguoi-dung', function (DangNhap $admin) {
            if ($admin->quyen && $admin->quyen->ten_quyen === 'Nhân Viên Chăm Sóc Khách Hàng' || $admin->quyen->ten_quyen === 'Nhân Viên'  || $admin->quyen->ten_quyen === 'Admin') {
                return true;
            }
            return false;
        });

    }
}
