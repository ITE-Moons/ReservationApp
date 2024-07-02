<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Resources\PasswordResetResource;
use App\Services\PasswordResetService;
use App\Models\PasswordReset;

class PasswordResetController extends GenericController
{
    private PasswordResetService $passwordResetService;


    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
        
        parent::__construct(new PasswordResetRequest(), new PasswordResetResource([]), new PasswordResetService(new PasswordReset()));
    }
}
