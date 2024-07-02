<?php

namespace App\Http\Resources;

class FavouriteResource extends GenericResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
			'id'          =>  $this->id,
            'place'       =>  new PlaceResource($this->place), 
		];
    }
}
