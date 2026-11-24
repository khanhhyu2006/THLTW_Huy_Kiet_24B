<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    // Thêm danh mục mẫu để kiểm tra thứ tự và lọc cả cha lẫn con.
    public function run(): void
    {
        $accessories = Category::firstOrCreate(['slug' => 'phu-kien'], [
            'name' => 'Phụ kiện', 'sort_order' => 20,
        ]);

        Category::firstOrCreate(['slug' => 'dien-thoai'], [
            'name' => 'Điện thoại', 'sort_order' => 10,
        ]);

        foreach ([
            ['slug' => 'tai-nghe', 'name' => 'Tai nghe', 'sort_order' => 20, 'status' => 1],
            ['slug' => 'sac-cap', 'name' => 'Sạc - Cáp', 'sort_order' => 10, 'status' => 1],
            ['slug' => 'phu-kien-an', 'name' => 'Phụ kiện ẩn', 'sort_order' => 0, 'status' => 0],
        ] as $child) {
            Category::firstOrCreate(['slug' => $child['slug']], $child + ['parent_id' => $accessories->id]);
        }

        Category::firstOrCreate(['slug' => 'danh-muc-an'], [
            'name' => 'Danh mục ẩn', 'status' => 0,
        ]);
    }
}
