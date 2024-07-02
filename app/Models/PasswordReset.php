<?php

namespace App\Models;

class PasswordReset extends GenericModel
{
    protected $table = 'password_resets';

	const UPDATED_AT = null;

    protected $fillable = [
		'email',
		'token',
	];
}

