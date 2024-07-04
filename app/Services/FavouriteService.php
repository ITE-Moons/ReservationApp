<?php

namespace App\Services;
Use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouriteService extends GenericService
{
    public function __construct()
    {
        parent::__construct(new Favourite());
    }

    public function store($validatedData)
    {
        DB::beginTransaction();

        $favorite = Favourite::where('place_id',$validatedData['place_id'])->where('user_id',Auth::user()->id)->first();

        $message = "";
        if($favorite != null){
            $favorite->delete();
            DB::commit();
            $message ="Place removed from Favorite successfully !";
            // return response()->json(['message' => "Place removed from Favorite successfully !"], 201);
        }
        else{

            $validatedData['user_id'] = Auth::user()->id;
            Favourite::create($validatedData);
            DB::commit();

            $message ="Place added to Favorite successfully !";

        }

        return $message;

    }

    public function getMyFavorite(){
        $model = Favourite::where('user_id', Auth::user()->id)->get();

        return $model;
    }
}
