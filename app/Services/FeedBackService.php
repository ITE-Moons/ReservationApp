<?php

namespace App\Services;

use App\Models\FeedBack;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FeedBackService extends GenericService
{
    public function __construct()
    {
        parent::__construct(new FeedBack());
    }

    public function store($validatedData){

        DB::beginTransaction();
        $validatedData['user_id'] = Auth::user()->id;
        $model = FeedBack::create($validatedData);
        DB::commit();

        return $model;
    }
}
