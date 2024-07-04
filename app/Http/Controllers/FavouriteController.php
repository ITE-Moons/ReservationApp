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

        $message = $this->service->store($validatedData);

        return $this->successResponse(
            null,
            $message
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
