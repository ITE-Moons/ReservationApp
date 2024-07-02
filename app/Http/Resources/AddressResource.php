<?php

namespace App\Http\Resources;

class AddressResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'          =>  $this->id,
			'goverment'   =>  $this->goverment,
			'city'        =>  $this->city,
			'area'        =>  $this->area,
			'street'      =>  $this->street,
		];
    }
}
