<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['parent_id', 'name', 'slug', 'description', 'image', 'sort_order', 'status'];

    // Ép kiểu dữ liệu khi đọc từ CSDL.
    protected function casts(): array
    {
        return [
            'parent_id' => 'integer',
            'sort_order' => 'integer',
            'status' => 'integer',
        ];
    }

    // Lấy danh mục cha theo parent_id.
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Lấy các danh mục con trỏ tới danh mục hiện tại.
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Lọc danh mục có status = 1.
    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }
}
