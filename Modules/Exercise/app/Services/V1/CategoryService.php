<?php

namespace Modules\Exercise\Services\V1;

use Modules\Exercise\Models\V1\Category;

class CategoryService
{
    public function getAll()
    {
        return Category::all();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(Category $category, array $data)
    {
        $category->update($data);

        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
