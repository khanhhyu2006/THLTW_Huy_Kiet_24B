<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    // Tạo hai thương hiệu công khai và một thương hiệu ẩn để kiểm tra bộ lọc.
    public function run(): void
    {
        Brand::firstOrCreate(['slug' => 'samsung'], ['name' => 'Samsung', 'sort_order' => 20]);
        Brand::firstOrCreate(['slug' => 'anker'], ['name' => 'Anker', 'sort_order' => 10]);
        Brand::firstOrCreate(['slug' => 'thuong-hieu-an'], ['name' => 'Thương hiệu ẩn', 'status' => 0]);
    }
}
