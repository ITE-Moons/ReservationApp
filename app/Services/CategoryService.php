<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Traits\FileTrait;

class CategoryService extends GenericService
{
    use FileTrait;

    public function __construct()
    {
        parent::__construct(new Category());
    }

    public function store($validatedData)
    {
        DB::beginTransaction();

        if(isset($validatedData['image'])){
            $filePath = $this->uploadFile($validatedData['image'], '/categories/' . $validatedData['name'] .'/' );
            $validatedData['image'] = $filePath;
        }

        $model = Category::create($validatedData);

        DB::commit();

        return $model;
    }
}
