<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController extends GenericController
{
    private CategoryService $categoryService;


    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
        
        parent::__construct(new CategoryRequest(), new CategoryResource([]), new CategoryService(new Category()));
    }
}
