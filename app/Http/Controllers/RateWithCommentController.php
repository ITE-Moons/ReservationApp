<?php

namespace App\Http\Controllers;

use App\Http\Requests\RateWithCommentRequest;
use App\Http\Resources\RateWithCommentResource;
use App\Services\RateWithCommentService;
use App\Models\RateWithComment;

class RateWithCommentController extends GenericController
{
    private RateWithCommentService $rateWithCommentService;


    public function __construct(RateWithCommentService $rateWithCommentService)
    {
        $this->rateWithCommentService = $rateWithCommentService;

        parent::__construct(new RateWithCommentRequest(), new RateWithCommentResource([]), new RateWithCommentService(new RateWithComment()));
    }

    public function getCommentsByPlaceId(RateWithCommentRequest $request){
        $comments = $this->rateWithCommentService->getCommentsByPlaceId($request);
        return $this->successResponse(
            $this->toResource($comments, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }
}
