<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Services\AdService;
use App\Models\Ad;

class AdController extends GenericController
{
    private AdService $adService;


    public function __construct(AdService $adService)
    {
        $this->adService = $adService;

        parent::__construct(new AdRequest(), new AdResource([]), new AdService(new Ad()));
    }

    public function getMyAds(){
        $ads= $this->adService->getMyAds();
        return $this->successResponse(
            $this->toResource($ads, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function getAdsRequest(){
        $ads = $this->adService->getAdsRequest();
        return $this->successResponse(
            $this->toResource($ads, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function approveRequest(AdRequest $request){
        $validatedData = $request->validated();
        $model = $this->adService->approveRequest($validatedData);
        return $this->successResponse(
            $this->toResource($model, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function rejectRequest(AdRequest $request){
        $validatedData = $request->validated();
        $model = $this->adService->rejectRequest($validatedData);
        return $this->successResponse(
            $this->toResource($model, $this->resource),
            __('TheRequestRejectedSuccessfully')
        );
    }
}
