<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Tạo bảng thương hiệu có slug duy nhất và thứ tự hiển thị.
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->index(['status', 'sort_order']);
        });
    }

    // Xóa bảng khi hoàn tác migration này.
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
