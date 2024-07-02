<?php

namespace App\Services;
Use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouriteService extends GenericService
{
    public function __construct()
    {
        parent::__construct(new Favourite());
    }

    public function store($validatedData)
    {
        DB::beginTransaction();
        $validatedData['user_id'] = Auth::user()->id;
        $model = Favourite::create($validatedData);
        DB::commit();

        return $model;
    }
}
