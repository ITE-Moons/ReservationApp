<?php

namespace App\Services;

use App\Models\Address;
Use App\Models\Image;
Use App\Models\AvailableTime;
use App\Models\Extension;
Use App\Models\Place;
use App\Models\Type;
Use App\Models\User;
use App\Traits\FileTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\License;
class PlaceService extends GenericService
{
    use FileTrait;

    public function __construct()
    {
        parent::__construct(new Place());
    }

    public function store($validatedData)
    {
        DB::beginTransaction();

        if(isset($validatedData['license'])){
            $filePath = $this->uploadFile($validatedData['license'], '/places/' .'/license/' );
            $validatedData['license'] = $filePath;
        }

        $validatedData['owner_id'] = Auth::user()->id;
        $validatedData['status'] = '0';
        $validatedData['date_of_add'] = Carbon::now();

        $model = Place::create($validatedData);


        if (isset($validatedData['images'])) {
            foreach($validatedData['images'] as $image){
                $filePath = $this->uploadFile($image, '/places/' . $model->name .'/' );
                Image::create([
                    'image' => $filePath,
                    'place_id' =>$model->id
                ]);
            }
        }

        if (isset($validatedData['available_times'])) {
            foreach($validatedData['available_times'] as $availableTime){
                AvailableTime::create([
                    'day' => $availableTime['day'],
                    'from_time' => $availableTime['from_time'],
                    'to_time' => $availableTime['to_time'],
                    'is_Active' => $availableTime['is_Active'],
                    'place_id' =>$model->id
                ]);
            }
        }

        if (isset($validatedData['address'])) {
            $address = $validatedData['address'];
            Address::create([
                'goverment' => $address['goverment'],
                'city' => $address['city'],
                'area' => $address['area'],
                'street' => $address['street'],
                'place_id' =>$model->id
            ]);

        }

        if (isset($validatedData['types'])) {
            foreach($validatedData['types'] as $type){
                Type::create([
                    'name' => $type,
                    'place_id' =>$model->id
                ]);
            }
        }

        if (isset($validatedData['extensions'])) {
            foreach($validatedData['extensions'] as $extension){
                Extension::create([
                    'name' => $extension['name'],
                    'description' => $extension['description'],
                    'price' => $extension['price'],
                    'place_id' =>$model->id
                ]);
            }
        }

        DB::commit();

        return $model;
    }

    public function update($id, $validatedData)
    {
        DB::beginTransaction();

        $place = Place::findOrFail($id);

        // تحديث الحقول الأساسية
        $updateData = [];
        if (isset($validatedData['name'])) {
            $updateData['name'] = $validatedData['name'];
        }
        if (isset($validatedData['maximum_capacity'])) {
            $updateData['maximum_capacity'] = $validatedData['maximum_capacity'];
        }
        if (isset($validatedData['price_per_hour'])) {
            $updateData['price_per_hour'] = $validatedData['price_per_hour'];
        }

        if (!empty($updateData)) {
            $place->update($updateData);
        }
        // تحديث الصور
        if (isset($validatedData['images'])) {
            $place->images()->delete();
            foreach ($validatedData['images'] as $image) {
                $filePath = $this->uploadFile($image, '/places/' . $place->name . '/');
                Image::create([
                    'image' => $filePath,
                    'place_id' => $place->id
                ]);
            }
        }

        // تحديث الأوقات المتاحة
        if (isset($validatedData['available_times'])) {
            $place->availableTimes()->delete();
            foreach($validatedData['available_times'] as $availableTime){
                AvailableTime::create([
                    'day' => $availableTime['day'],
                    'from_time' => $availableTime['from_time'],
                    'to_time' => $availableTime['to_time'],
                    'is_Active' => $availableTime['is_Active'],
                    'place_id' =>$place->id
                ]);
            }
        }

        // تحديث الأنواع
        if (isset($validatedData['types'])) {
            $place->types()->delete();
            foreach ($validatedData['types'] as $type) {
                Type::create([
                    'name' => $type,
                    'place_id' => $place->id
                ]);
            }
        }

        // تحديث الملحقات
        if (isset($validatedData['extensions'])) {
            $place->extensions()->delete();
            foreach ($validatedData['extensions'] as $extension) {
                Extension::create([
                    'name' => $extension['name'],
                    'description' => $extension['description'],
                    'price' => $extension['price'],
                    'place_id' => $place->id
                ]);
            }
        }

        DB::commit();

        return $place;
    }


    public function search($validatedData){
        $model = Place::where('name','LIKE','%'. $validatedData['name'] .'%')->get();

        return $model;
    }

    public function getPlacesRequest(){

        $places = Place::where('status','0')->get();
        return $places;
    }

    public function getAll(){
        {
            $user = Auth::user();
            $places = Place::with('favouritedBy')->where('status','1')->get();

            $places->each(function ($place) use ($user) {
                $place->is_favourite = $place->favouritedBy->contains($user);
            });

            return $places;
        }
        // $places = Place::where('status','1')->get();
    }

    public function getMyPlaces(){
        $user = Auth::user();
        $places = Place::where('owner_id',$user->id)->where('status','1')->get();

        return $places;
    }

    public function approveRequest($validatedData){
        $model = Place::find($validatedData['id']);
        $model->status = '1';
        $user = User::find($model ->owner_id);
        if($user->role == 'USER'){
            $user->role = 'INVESTOR';
            $user->save();
        }
        $model->save();
        return $model;
    }

    public function rejectRequest($validatedData){
        $model = Place::find($validatedData['id']);
        $model->status = '-1';
        $model->save();
        return $model;
    }

    public function getPlacesByCatId($validatedData){

        $user = Auth::user();
        $places = Place::with('favouritedBy')->where('status','1')->where('category_id', $validatedData['id'])->get();

            $places->each(function ($place) use ($user) {
                $place->is_favourite = $place->favouritedBy->contains($user);
            });

            return $places;
    }

    public function filterPlace($validatedData)
    {
        // فلترة حسب السعر
        if (isset($validatedData['sort_by_price'])) {

            if ($validatedData['sort_by_price'] == 'desc') {
                return Place::orderByDesc('price_per_hour')->get();
            }
        }
        //test2
        if (isset($validatedData['by_price2'])) {

            if ($validatedData['by_price2'] == 'asc') {
                return Place::orderByDesc('price_per_hour')->get();
            }
        }
         //حسب السعر المدخل
         if (isset($validatedData['by_price'])) {

            return Place::where('price_per_hour','>=',$validatedData['by_price'])->get();

        }

         // فلترة حسب التقييم
         if (isset($validatedData['sort_by_rate'])) {
            if ($validatedData['sort_by_rate'] == 'desc') {
                $places = Place::with('rateWithComments')->get();

                $places = $places->map(function ($place) {
                    $place->average_rate = $place->rateWithComments->avg('rate');
                    return $place;
                });

                $places = $places->sortByDesc('average_rate');

                return $places->values();
            }
        }

        return null;
    }

}
