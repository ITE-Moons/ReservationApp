<?php

namespace App\Http\Requests;

class ReservationRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'place_id'       =>  'required|integer|exists:places,id',
			'type_id'        =>  'required|integer|exists:types,id',
			'date_and_time'  =>  'required|date|date_format:Y-m-d',
            'start_time'     =>  'required|date_format:H:i:s',
            'end_time'       =>  'required|date_format:Y-m-d H:i:s',
            'extensions'     => 'nullable|array',
            'extensions.*'   => 'required|integer|exists:extensions,id'
		];
    }

    private function storeTestValidator()
    {
        return [
			'place_id'       =>  'required|integer|exists:places,id',
			'type_id'        =>  'required|integer|exists:types,id',
			'date_and_time'  =>  'required|date|date_format:Y-m-d',
            'start_time'     =>  'required|date_format:H:i:s',
            'end_time'       =>  'required|date_format:Y-m-d H:i:s',
            'extensions'     => 'nullable|array',
            'extensions.*'   => 'required|integer|exists:extensions,id'
		];
    }
    private function storeFromDayValidator()
    {
        return [
			'place_id'       =>  'required|integer|exists:places,id',
			'type_id'        =>  'required|integer|exists:types,id',
			'date_and_time'  =>  'required|date|date_format:Y-m-d',
            'numOfDay'       =>  'required|integer',
            'extensions'     => 'nullable|array',
            'extensions.*'   => 'required|integer|exists:extensions,id'
		];
    }
    private function makeDayValidator()
    {
        return [
			'place_id'       =>  'required|integer|exists:places,id',
			'type_id'        =>  'required|integer|exists:types,id',
			'date_and_time'  =>  'required|date|date_format:Y-m-d',
            'numOfDay'       =>  'required|integer',
            'extensions'     => 'nullable|array',
            'extensions.*'   => 'required|integer|exists:extensions,id'
		];
    }

    private function makeHourValidator()
    {
        return [
			'place_id'       =>  'required|integer|exists:places,id',
			'type_id'        =>  'required|integer|exists:types,id',
			'date_and_time'  =>  'required|date|date_format:Y-m-d',
            'start_time'     =>  'required|date_format:H:i:s',
            'end_time'       =>  'required|date_format:Y-m-d H:i:s',
            'extensions'     => 'nullable|array',
            'extensions.*'   => 'required|integer|exists:extensions,id'
		];
    }
    private function updateValidator()
    {
        return [
			'type_id'        =>  'required|integer|exists:types,id',
			'date_and_time'  =>  'required|date|date_format:Y-m-d',
            'day'            =>   'required|in:Sun,Mon,Tue,Wed,Thu,Fri,Sat',
            'start_time'     =>  'required|date_format:H:i:s',
            'end_time'       =>  'required|date_format:Y-m-d H:i:s',
		];
    }

    private function getPlaceReservationValidator()
    {
        return [
			'id'       =>  'required|integer|exists:places,id',
        ];
    }
}
