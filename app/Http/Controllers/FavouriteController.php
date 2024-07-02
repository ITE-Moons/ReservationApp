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
}
