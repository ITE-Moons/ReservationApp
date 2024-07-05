<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavouriteRequest;
use App\Http\Resources\FavouriteResource;
use App\Services\FavouriteService;
use App\Models\Favourite;

class FavouriteController extends GenericController
{
    private FavouriteService $favouriteService;


    public function __construct(FavouriteService $favouriteService)
    {
        $this->favouriteService = $favouriteService;

        parent::__construct(new FavouriteRequest(), new FavouriteResource([]), new FavouriteService(new Favourite()));

    }

    public function store()
    {
        $validatedData = request()->validate($this->request->rules());

        $result = $this->service->store($validatedData);

        if (is_array($result) && isset($result['message'])) {
            return response()->json(['message' => $result['message']], 201);
        }

        return $this->successResponse(
            $this->toResource($result, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }


    public function getMyFavorite(){
        $favorites = $this->favouriteService->getMyFavorite();
        return $this->successResponse(
             $this->toResource($favorites, $this->resource),
             __('messages.dataFetchedSuccessfully')
         );
    }
}
