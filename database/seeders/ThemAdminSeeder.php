<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DangNhap;
use Illuminate\Support\Facades\Hash;
class ThemAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = new DangNhap();
        $admin->ten           = "Đoàn Tuấn Khanh";
        $admin->ten_dang_nhap = "TuanKhanh34";
        $admin->dia_chi = "188 Võ Thị Tần";
        $admin->email = "Khanh179c@gmail";
        $admin->password      = Hash::make('abcxyz');
        $admin->quyen_id      = 4;
        $admin->save();
    }
}
