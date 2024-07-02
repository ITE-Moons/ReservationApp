<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\URL;

class AdResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'           =>  $this->id,
			'user_id'      =>  $this->user_id,
			'image'        =>  isset($this->image) ? URL::asset('') . $this->image : null,
			'description'  =>  $this->description,
			'status'       =>  $this->status,
			'created_at'   =>  $this->created_at,
		];
    }
}
