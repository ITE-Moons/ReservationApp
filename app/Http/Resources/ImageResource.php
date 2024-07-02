<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\URL;
class ImageResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'          =>  $this->id,
			'image'       =>  isset($this->image) ? URL::asset('') . $this->image : null,
			'place_id'    =>  $this->place_id,
		];
    }
}
