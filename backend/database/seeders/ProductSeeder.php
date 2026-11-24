<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    // Tạo 15 sản phẩm công khai và một sản phẩm ẩn để thử phân trang.
    public function run(): void
    {
        $category = Category::where('slug', 'tai-nghe')->firstOrFail();
        $brand = Brand::where('slug', 'anker')->firstOrFail();

        for ($number = 1; $number <= 16; $number++) {
            Product::firstOrCreate(['slug' => "tai-nghe-mau-$number"], [
                'category_id' => $category->id,
                'brand_id' => $brand->id,
                'name' => "Tai nghe mẫu $number",
                'price' => 200000 + $number * 10000,
                'status' => $number <= 15,
            ]);
        }
    }
}
