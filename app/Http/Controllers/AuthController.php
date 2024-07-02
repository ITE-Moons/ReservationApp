<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    protected AuthService $service;

    public function __construct(
        AuthService $service
    ) {
        $this->service = $service;
    }

    public function login(AuthRequest $request)
    {
        $validatedData = $request->validated();
        $token = $this->service->login($validatedData);

        return $this->successResponse(
            $this->toResource(Auth::user(), UserResource::class),
            __('auth.userSuccessfullyLoggedIn'),
            200,
            $token
        );
    }

    public function register(AuthRequest $request)
    {
        $validatedData = $request->validated();
        $token = $this->service->register($validatedData);

        return $this->successResponse(
            $this->toResource(Auth::user(), UserResource::class),
            __('auth.userSuccessfullyRegistered'),
            200,
            $token
        );
    }

    public function updateProfile(AuthRequest $request)
    {
        $validatedData = $request->validated();
        $updatedUser = $this->service->updateProfile($validatedData);

        return $this->successResponse(
            $this->toResource($updatedUser, UserResource::class),
            __('messages.dataUpdatedSuccessfully'),
            200
        );
    }

    public function getUserProfile()
    {
        $user = $this->service->getUserProfile();

        return $this->successResponse(
            $this->toResource($user, UserResource::class),
            __('messages.dataFetchedSuccessfully'),
            200
        );
    }

    public function logout()
    {
        $this->service->logout();

        return $this->successResponse(
            null,
            __('auth.userSuccessfullyLoggedOut'),
            200
        );
    }
}