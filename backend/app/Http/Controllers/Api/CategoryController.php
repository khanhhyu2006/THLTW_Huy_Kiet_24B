<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Schema;

class CategoryController extends Controller
{
    // Lấy danh mục công khai và sắp xếp cả hai cấp theo cấu hình nếu có.
    public function index(): AnonymousResourceCollection
    {
        $hasSortOrder = Schema::hasColumn('categories', 'sort_order');
        $order = fn ($query) => $query
            ->when($hasSortOrder, fn ($query) => $query->orderBy('sort_order'))
            ->orderBy('id');

        $categories = $order(Category::active()->whereNull('parent_id'))
            ->with(['children' => fn ($query) => $order($query->active())])
            ->get();

        return CategoryResource::collection($categories);
    }

    // Trả danh mục đang hiển thị theo slug, hoặc HTTP 404.
    public function show(string $slug): CategoryResource
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();

        return new CategoryResource($category);
    }
}
