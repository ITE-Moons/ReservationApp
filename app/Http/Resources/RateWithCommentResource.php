<?php

namespace App\Http\Resources;

class RateWithCommentResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'          =>  $this->id,
			'user_id'     =>  $this->user('id')->get('name'),
			'place_id'    =>  $this->place_id,
			'text'        =>  $this->text,
			'created_at'  =>  $this->created_at,
		];
    }
}
