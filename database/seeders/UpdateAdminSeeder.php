<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DangNhap;
use Illuminate\Support\Facades\Hash;

class UpdateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = DangNhap::all();
        foreach($admin as $ad){
        $ad->password = Hash::make($admin->password);
        }
    }
}
