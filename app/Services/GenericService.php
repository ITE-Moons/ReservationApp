<?php

namespace App\Services;

use Exception;
use App\Models\GenericModel;
use Illuminate\Support\Facades\DB;

class GenericService
{
    private GenericModel $model;


    public function __construct(GenericModel $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model::orderByDesc('created_at')->get();
    }

    public function findById($modelId)
    {
        $model = $this->model::find($modelId);

        if (!$model) {
            throw new Exception(__('validation.exists', ['attribute' => __('models.' . class_basename($this->model))]), 404);
        }

        return $model;
    }

    public function store($validatedData)
    {
        DB::beginTransaction();

        $model = $this->model::create($validatedData);

        DB::commit();

        return $model;
    }

    public function bulkStore($validatedData)
    {
        DB::beginTransaction();

        $items = collect($validatedData['list'])->map(function ($record) {
            return $this->model::create($record);
        });

        DB::commit();

        return $items;
    }

    public function update($modelId , $validatedData)
    {
        $model = $this->findById($modelId);

        DB::beginTransaction();

        $model->update($validatedData);

        DB::commit();

        return $model;
    }

    public function delete($modelId)
    {
        $model = $this->findById($modelId);

        DB::beginTransaction();

        $model->delete();

        DB::commit();
    }

    public function bulkDelete($validatedData)
    {
        DB::beginTransaction();

        $this->model::whereIn('id', $validatedData['ids'])->delete();

        DB::commit();
    }
}
