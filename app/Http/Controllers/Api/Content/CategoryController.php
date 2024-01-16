<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public function index(CategoryRepository $categoryRepository)
    {
        return CategoryResource::collection($categoryRepository->getAllRootCategories());
    }
}
