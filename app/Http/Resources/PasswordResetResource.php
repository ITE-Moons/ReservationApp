<?php

namespace App\Http\Resources;

class PasswordResetResource extends GenericResource
{
    public function toArray($request)
    {
        return [
			'email'       =>  $this->email,
			'token'       =>  $this->token,
			'created_at'  =>  $this->created_at,
		];
    }
}
