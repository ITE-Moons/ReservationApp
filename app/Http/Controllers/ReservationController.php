<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Services\ReservationService;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends GenericController
{
    private ReservationService $reservationService;


    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;

        parent::__construct(new ReservationRequest(), new ReservationResource([]), new ReservationService(new Reservation()));
    }

    public function getMyReservation(){
        $reservation = $this->reservationService->getMyReservation();
       return $this->successResponse(
            $this->toResource($reservation, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function getPlaceReservation(ReservationRequest $request){

        $validatedData = $request->validated();
        $reservation = $this->reservationService->getPlaceReservation($validatedData);
       return $this->successResponse(
            $this->toResource($reservation, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function getTimes($id, Request $request){
        $date = $request->input('date');

        return $this->reservationService->viewAvailableTimes5($id,$date);
    }
    public function getDay($id){

        return $this->reservationService->viewAvailableDay($id);
    }

    public function storeTest(ReservationRequest $request){
        return $this->reservationService->store($request->all());

    }
    public function storeFromDay(ReservationRequest $request){
        return $this->reservationService->storeFromDay($request->all());

    }

    public function makeHour(ReservationRequest $request){

        $validatedData = $request->validated();
        $model = $this->reservationService->makeHour($validatedData);

        return $this->successResponse($model);
    }
    public function makeDay(ReservationRequest $request){

        $validatedData = $request->validated();
        $model = $this->reservationService->makeDay($validatedData);

        return $this->successResponse($model);
    }

}
