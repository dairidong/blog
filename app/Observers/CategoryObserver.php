<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    public function saving(Category $category)
    {
        if (empty($category->icon)) {
            $category->icon = '';
        }
    }
}
