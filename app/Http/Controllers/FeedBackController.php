<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedBackRequest;
use App\Http\Resources\FeedBackResource;
use App\Services\FeedBackService;
use App\Models\FeedBack;

class FeedBackController extends GenericController
{
    private FeedBackService $feedBackService;


    public function __construct(FeedBackService $feedBackService)
    {
        $this->feedBackService = $feedBackService;
        
        parent::__construct(new FeedBackRequest(), new FeedBackResource([]), new FeedBackService(new FeedBack()));
    }
}
