<?php

namespace App\Http\Resources;

class UserResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'id'          =>  $this->id,
			'name'        =>  $this->name,
			'email'       =>  $this->email,
			'user_name'   =>  $this->user_name,
			'role'        =>  $this->role,
			'balance'     =>  $this->balance,
		];
    }
}
