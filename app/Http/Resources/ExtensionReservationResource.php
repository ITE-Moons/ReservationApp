<?php

namespace App\Http\Resources;

class ExtensionReservationResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'              =>  $this->id,
			'reservation_id'  =>  $this->reservation_id,
			'extension_id'    =>  $this->extension_id,
			'created_at'      =>  $this->created_at,
		];
    }
}
