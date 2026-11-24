<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BrandController extends Controller
{
    // Lấy thương hiệu đang hiển thị và giao cho Resource định dạng.
    public function index(): AnonymousResourceCollection
    {
        return BrandResource::collection(Brand::active()->orderBy('sort_order')->orderBy('id')->get());
    }
}
