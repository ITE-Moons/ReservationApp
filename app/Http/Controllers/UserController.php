<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Models\User;

class UserController extends GenericController
{
    private UserService $userService;


    public function __construct(UserService $userService)
    {
        $this->userService = $userService;

        parent::__construct(new UserRequest(), new UserResource([]), new UserService(new User()));
    }

    public function getAllInvestors(){

        $user = $this->userService->getAllInvestors();

        return $this->successResponse(
            $this->toResource($user, $this->resource),
            __('messages.dataFetchedSuccessfully')
        );
    }

    public function chargeBalance($id,UserRequest $request){

        $validatedData = $request->validated();

        $user = $this->userService->chargeBalance($id, $validatedData);
        return $this->successResponse(
            $this->toResource($user, $this->resource),
            __('Balance charged successfully !')
            );
    }
}
