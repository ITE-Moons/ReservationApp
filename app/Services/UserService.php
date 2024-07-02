<?php

namespace App\Services;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
Use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService extends GenericService
{
    use FileTrait;

    public function __construct()
    {
        parent::__construct(new User());
    }

    public function store($validatedData)
    {

        $validatedData['role']          = 'INVESTOR';
        $validatedData['password']      = Hash::make($validatedData['password']);

        DB::beginTransaction();

        $user=User::create($validatedData);

        DB::commit();
        return $user;
    }

    public function getAllInvestors()
    {
        $users = User::where('role', 'INVESTOR')->orderByDesc('name')->get();
        return $users;
    }

    public function update($id, $validatedData)
    {
        DB::beginTransaction();

        $user = User::findOrFail($id);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        DB::commit();

        return $user;
    }

    public function chargeBalance($id,$validatedData){
        $user = User::findOrFail($id);
        $user->balance = $validatedData['amount'];
        $user->save();
        return $user;
    }

}
