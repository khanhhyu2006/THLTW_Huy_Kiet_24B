<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    // Lấy sản phẩm đang hiển thị, mới nhất trước, mỗi trang tối đa 12 mục.
    public function index(): AnonymousResourceCollection
    {
        $products = Product::active()
            ->when(Schema::hasColumn('products', 'deleted_at'), fn ($query) => $query->whereNull('deleted_at'))
            ->latest('id')
            ->paginate(12);

        return ProductResource::collection($products);
    }
}
