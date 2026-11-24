<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['name', 'slug', 'sort_order', 'status'];

    // Lọc thương hiệu có status = 1.
    public function scopeActive(Builder $query): void
    {
        $query->where('status', 1);
    }
}
