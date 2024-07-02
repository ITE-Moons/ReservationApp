<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExtensionReservationRequest;
use App\Http\Resources\ExtensionReservationResource;
use App\Services\ExtensionReservationService;
use App\Models\ExtensionReservation;

class ExtensionReservationController extends GenericController
{
    private ExtensionReservationService $extensionReservationService;


    public function __construct(ExtensionReservationService $extensionReservationService)
    {
        $this->extensionReservationService = $extensionReservationService;
        
        parent::__construct(new ExtensionReservationRequest(), new ExtensionReservationResource([]), new ExtensionReservationService(new ExtensionReservation()));
    }
}
