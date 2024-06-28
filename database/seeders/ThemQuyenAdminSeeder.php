<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quyen;
class ThemQuyenAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quyen = new Quyen();
        $quyen->ten_quyen = "Quản Lý";
        $quyen->save();
    }

}
