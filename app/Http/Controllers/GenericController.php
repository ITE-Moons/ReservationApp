<?php

namespace App\Http\Controllers;

use App\Services\GenericService;
use App\Http\Requests\GenericRequest;
use App\Http\Resources\GenericResource;

class GenericController extends ApiController
{
    protected GenericRequest $request;

    protected GenericResource $resource;

    protected GenericService $service;


    public function __construct(
        GenericRequest $request,
        GenericResource $resource,
        GenericService $service
    ) {
        $this->request = $request;
        $this->resource = $resource;
        $this->service = $service;
    }


    public function getAll()
    {
        $items = $this->service->getAll();

        return $this->successResponse(
            $this->toResource($items, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function findById($modelId)
    {
        $model = $this->service->findById($modelId);

        return $this->successResponse(
            $this->toResource($model, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function store()
    {
        $validatedData = request()->validate($this->request->rules());

        $model = $this->service->store($validatedData);

        return $this->successResponse(
            $this->toResource($model, $this->resource),
            __('messages.dataAddedSuccessfully')
        );
    }

    public function update($modelId)
    {
        $validatedData = request()->validate($this->request->rules());

        $model = $this->service->update($modelId , $validatedData);

        return $this->successResponse(
            $this->toResource($model, $this->resource),
            __('messages.dataUpdatedSuccessfully')
        );
    }

    public function delete($modelId)
    {
        $this->service->delete($modelId);

        return $this->successResponse(
            null,
            __('messages.dataDeletedSuccessfully')
        );
    }

}
