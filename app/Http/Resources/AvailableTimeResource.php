<?php

namespace App\Http\Resources;

class AvailableTimeResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'day'         =>  $this->day,
			'from_time'   =>  $this->from_time,
			'to_time'     =>  $this->to_time,
			'is_Active'   =>  $this->is_Active,
        ];
    }
}
