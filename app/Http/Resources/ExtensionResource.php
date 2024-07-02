<?php

namespace App\Http\Resources;

class ExtensionResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'           =>  $this->id,
			'name'         =>  $this->name,
			'description'  =>  $this->description,
			'price'        =>  $this->price,
		];
    }
}
