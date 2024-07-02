<?php

namespace App\Http\Requests;

class AvailableTimeRequest extends GenericRequest
{
    public function rules()
    {
        $method = request()->route()->getActionMethod();
        return $this->{$method . 'Validator'}();
    }

    private function storeValidator()
    {
        return [
			'day'        =>  'required|in:Sun,Mon,Tue,Wed,Thu,Fri,Sat',
			'from_time'  =>  'required|date_format:H:i',
			'to_time'    =>  'required|date_format:H:i',
			'is_Active'  =>  'required|integer',
			'place_id'   =>  'required|integer|exists:places,id',
        ];
    }

    private function updateValidator()
    {
        return [
			'day'        =>  'required|in:Sun,Mon,Tue,Wed,Thu,Fri,Sat',
			'from_time'  =>  'required|date_format:H:i:s',
			'to_time'    =>  'required|date_format:H:i:s',
			'is_Active'  =>  'required|integer',
			'place_id'   =>  'required|integer|exists:places,id',
        ];
    }

}
