<?php

namespace App\Http\Resources;

class TypeResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'          =>  $this->id,
			'name'        =>  $this->name,
			'place'    =>  $this->place('id')->get('name'),
		];
    }
}
