<?php

namespace App\Services;

use App\Models\RateWithComment;

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
}
