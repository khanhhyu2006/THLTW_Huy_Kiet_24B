<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Schema;

class BrandController extends Controller
{
    // Lấy thương hiệu đang hiển thị và giao cho Resource định dạng.
    public function index(): AnonymousResourceCollection
    {
        $brands = Brand::active()
            ->when(Schema::hasColumn('brands', 'sort_order'), fn ($query) => $query->orderBy('sort_order'))
            ->orderBy('id')
            ->get();

        return BrandResource::collection($brands);
    }
}
