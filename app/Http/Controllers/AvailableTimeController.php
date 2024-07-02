<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvailableTimeRequest;
use App\Http\Resources\AvailableTimeResource;
use App\Services\AvailableTimeService;
use App\Models\AvailableTime;

class AvailableTimeController extends GenericController
{
    private AvailableTimeService $availableTimeService;


    public function __construct(AvailableTimeService $availableTimeService)
    {
        $this->availableTimeService = $availableTimeService;
        
        parent::__construct(new AvailableTimeRequest(), new AvailableTimeResource([]), new AvailableTimeService(new AvailableTime()));
    }
}
