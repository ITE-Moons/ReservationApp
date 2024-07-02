<?php

namespace App\Services;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function login($validatedData)
    {
        $user = User::where('user_name', $validatedData['user_name'])->first();

        if (!$user) {
            throw new Exception(__('auth.failed'), 401);
        }

        $attemptedData = [
            'user_name'     => $user->user_name,
            'password'      => $validatedData['password']
        ];

        if (!$token = Auth::attempt($attemptedData)) {
            throw new Exception(__('auth.incorrect_password'), 401);
        }

        return $token;
    }


    public function register($validatedData)
    {
        $attemptedData = [
            'user_name'     => $validatedData['user_name'],
            'password'      => $validatedData['password']
        ];

        $validatedData['role']          = 'USER';
        $validatedData['password']      = Hash::make($validatedData['password']);

        DB::beginTransaction();

        $user=User::create($validatedData);

        DB::commit();


        if (!$token = Auth::attempt($attemptedData)) {
            throw new Exception(__('auth.incorrect_password'), 401);
        }

        return $token;
    }


    public function updateProfile($validatedData)
    {
        /**
         * @var User $user
         */
        $user = Auth::user();
        $validatedData['password'] = Hash::make($validatedData['password']);
        DB::beginTransaction();

        $user->update($validatedData);

        DB::commit();

        return $user;
    }



    public function getUserProfile()
    {
        return Auth::user();
    }


    public function logout()
    {
        Auth::logout();
    }
}
