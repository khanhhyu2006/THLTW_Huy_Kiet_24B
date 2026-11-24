<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    // Lấy sản phẩm đang hiển thị, mới nhất trước, mỗi trang tối đa 12 mục.
    public function index(): AnonymousResourceCollection
    {
        $products = $this->visibleProducts()->latest('id')->paginate(12);

        return ProductResource::collection($products);
    }

    // Tra sản phẩm công khai theo slug.
    public function show(string $slug): ProductResource
    {
        return new ProductResource($this->visibleProducts()->where('slug', $slug)->firstOrFail());
    }

    // Tra sản phẩm công khai bằng khóa chính.
    public function showById(string $id): ProductResource
    {
        return new ProductResource($this->visibleProducts()->findOrFail($id));
    }

    // Dùng chung bộ lọc hiển thị cho danh sách và chi tiết.
    private function visibleProducts(): Builder
    {
        return Product::active()
            ->when(Schema::hasColumn('products', 'deleted_at'), fn ($query) => $query->whereNull('deleted_at'));
    }
}
