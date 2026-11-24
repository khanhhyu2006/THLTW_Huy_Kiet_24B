<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{
    // Lấy sản phẩm đang hiển thị, mới nhất trước, mỗi trang tối đa 12 mục.
    public function index(): AnonymousResourceCollection
    {
        $products = Product::active()->latest('id')->paginate(12);

        return ProductResource::collection($products);
    }
}
