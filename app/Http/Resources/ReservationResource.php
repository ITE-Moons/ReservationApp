<?php

namespace App\Http\Resources;

class ReservationResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'             =>  $this->id,
			'place'       =>  $this->place,
            'extension'   =>  ExtensionResource::collection($this->whenLoaded('extensions')),
			'user'        =>  $this->user,
			'type'        =>  $this->type,
			'total_price'    =>  $this->total_price,
			'date_and_time'  =>  $this->date_and_time,
            'day'            =>  $this->day,
            'start_time'     => $this->start_time,
            'end_time'       => $this->end_time,
		];
    }
}
