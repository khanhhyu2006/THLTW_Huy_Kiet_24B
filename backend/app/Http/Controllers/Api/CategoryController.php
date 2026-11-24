<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    // Lấy danh mục gốc và danh mục con đang hiển thị theo sort_order.
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::active()
            ->whereNull('parent_id')
            ->with(['children' => fn ($query) => $query->active()->orderBy('sort_order')->orderBy('id')])
            ->orderBy('sort_order')
            ->orderBy('id')
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
