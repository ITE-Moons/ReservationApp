<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\URL;

class CategoryResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'          =>  $this->id,
			'name'        =>  $this->name,
			'image'       =>  isset($this->image) ? URL::asset('') . $this->image : null,
			'created_at'  =>  $this->created_at,
		];
    }
}
