<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ApiPracticeSeeder extends Seeder
{
    // Nạp dữ liệu mẫu theo thứ tự khóa ngoại.
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
