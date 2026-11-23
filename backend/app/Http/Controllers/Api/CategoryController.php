<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryController extends Controller
{
    // GET /api/categories
    public function index(): AnonymousResourceCollection
    {
        $categories = Category::active()        // (1) scope của Model
            ->whereNull('parent_id')            // (2) danh mục gốc
            ->with(['children' => fn ($q) => $q->active()])  // (1)
            ->get();                            // trả về tập Model

        return CategoryResource::collection($categories);
    }
}
