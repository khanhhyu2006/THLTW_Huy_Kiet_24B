<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'brand_id', 'name', 'slug', 'price', 'status'];

    // Giữ giá tiền ở dạng chuỗi thập phân có hai chữ số.
    protected function casts(): array
    {
        return ['price' => 'decimal:2'];
    }

    // Lọc sản phẩm có status = 1.
    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }
}
