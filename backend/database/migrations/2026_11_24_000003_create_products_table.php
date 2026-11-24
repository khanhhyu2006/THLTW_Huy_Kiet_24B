<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Tạo bảng sản phẩm với liên kết tới danh mục và thương hiệu.
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->foreignId('brand_id')->constrained()->restrictOnDelete();
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->decimal('price', 14, 2);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->index(['status', 'id']);
        });
    }

    // Xóa bảng khi hoàn tác migration này.
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
