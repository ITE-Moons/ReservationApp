<?php

namespace App\Services;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\DB;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;

class AdService extends GenericService
{
    use FileTrait;


    public function __construct()
    {
        parent::__construct(new Ad());
    }

    public function store($validatedData)
    {
        if (isset($validatedData['image'])) {
            $filePath = $this->uploadFile($validatedData['image'], '/ads/');
            $validatedData['image'] = $filePath;
        }

        DB::beginTransaction();

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['status'] = '0';

        $model = Ad::create($validatedData);

        DB::commit();

        return $model;
    }


    public function getAdsRequest(){

        $ads = Ad::where('status','0')->get();
        return $ads;
    }

    public function approveRequest($validatedData){
        $model = Ad::find($validatedData['id']);
        $model->status = '1';
        $model->save();
        return $model;
    }

    public function rejectRequest($validatedData){
        $model = Ad::find($validatedData['id']);
        $model->status = '-1';
        $model->save();
        return $model;
    }

    public function getMyAds() {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $ads = Ad::where('user_id', $user->id)
        ->where('status', 1)
        ->get();

        return $ads;
    }

}
