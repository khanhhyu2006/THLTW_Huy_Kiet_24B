<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Schema;

class CategoryController extends Controller
{
    // Phân trang toàn bộ danh mục công khai, gồm cả danh mục cha và con.
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::active()
            ->when(Schema::hasColumn('categories', 'sort_order'), fn ($query) => $query->orderBy('sort_order'))
            ->orderBy('id')
            ->paginate(12);

        return CategoryResource::collection($categories);
    }

    // Tra danh mục công khai theo slug.
    public function show(string $slug): CategoryResource
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();

        return new CategoryResource($category);
    }

    // Tra danh mục công khai bằng khóa chính.
    public function showById(string $id): CategoryResource
    {
        return new CategoryResource(Category::active()->findOrFail($id));
    }
}
