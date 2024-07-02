<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Http\Resources\PlaceResource;
use App\Services\PlaceService;
use App\Models\Place;

class PlaceController extends GenericController
{
    private PlaceService $placeService;


    public function __construct(PlaceService $placeService)
    {
        $this->placeService = $placeService;

        parent::__construct(new PlaceRequest(), new PlaceResource([]), new PlaceService(new Place()));
    }

    public function getAll(){
        $places = $this->placeService->getAll();
        return $this->successResponse(
            $this->toResource($places, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function getMyPlaces(){
        $places = $this->placeService->getMyPlaces();
       return $this->successResponse(
            $this->toResource($places, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function search(PlaceRequest $request){

        $validatedData = $request->validated();
        $model = $this->placeService->search($validatedData);

        return $this->successResponse(
            $this->toResource($model, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function getPlacesRequest(){
        $places = $this->placeService->getPlacesRequest();
        return $this->successResponse(
            $this->toResource($places, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function getPlacesByCatId(PlaceRequest $request){
        $places = $this->placeService->getPlacesByCatId($request);
        return $this->successResponse(
            $this->toResource($places, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function approveRequest(PlaceRequest $request){
        $validatedData = $request->validated();
        $model = $this->placeService->approveRequest($validatedData);
        return $this->successResponse(
            $this->toResource($model, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function rejectRequest(PlaceRequest $request){
        $validatedData = $request->validated();
        $model = $this->placeService->rejectRequest($validatedData);
        return $this->successResponse(
            $this->toResource($model, $this->resource),
            __('TheRequestRejectedSuccessfully')
        );
    }

    public function filterPlace(PlaceRequest $request){
        $validatedData = $request->validated();
        $places = $this->placeService->filterPlace($validatedData);
        return $this->successResponse(
            $this->toResource($places, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }
}
