<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function show(string $category_id, CategoryRepository $categoryRepository)
    {
        $category = $categoryRepository->getById($category_id);

        return Inertia::render("Category/CategoryShow", ['category' => new CategoryResource($category)]);
    }
}
