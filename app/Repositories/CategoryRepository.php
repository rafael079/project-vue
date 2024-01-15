<?php

namespace App\Repositories;

use App\Services\Util\HashIdService;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Category;

class CategoryRepository
{

    public function getById(string $id): Category
    {
        $id = (new HashIdService)->decode($id);

        $category = Category::findOrFail($id);

        return $category;

    }

    public function getAllRootCategories(): Collection
    {
        $categories = Category::root()->get();

        return $categories;
    }
}