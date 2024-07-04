<?php

namespace App\Services;

use App\Models\RateWithComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RateWithCommentService extends GenericService
{
    public function __construct()
    {
        parent::__construct(new RateWithComment());
    }

    public function getCommentsByPlaceId($validatedData){

        $comments = RateWithComment::where('place_id', $validatedData['place_id'])->get();

        return $comments ;
    }

    public function store($validatedData){

        DB::beginTransaction();
        $validatedData['user_id'] = Auth::user()->id;
        $model = RateWithComment::create($validatedData);
        DB::commit();

        return $model;
    }
}
