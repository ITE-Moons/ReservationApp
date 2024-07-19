<?php

namespace App\Services;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\AvailableTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Extension;
use App\Models\ExtensionReservation;
use App\Models\Place;



class ReservationService extends GenericService
{
    public function viewAvailableTimes($placeId, $date)
{
    $date1 = Carbon::parse($date)->toDateString();
    $dayName = Carbon::parse($date1)->format('D');

    $availableTimes = AvailableTime::where('place_id', $placeId)
        ->where('is_active', 1)
        ->where('day', $dayName)
        ->get();

    $reservations = Reservation::where('place_id', $placeId)
        ->whereDate('date_and_time', $date)
        ->get();

    $availableSlots = [];

    foreach ($availableTimes as $availableTime) {
        $startTime = Carbon::parse($availableTime->from_time);
        $endTime = Carbon::parse($availableTime->to_time);

        for ($time = $startTime->copy(); $time < $endTime; $time->addHour()) {
            $slotStart = $time->format('H:i:s');
            $slotEnd = $time->copy()->addHour()->format('H:i:s');

            $isBooked = $reservations->filter(function ($reservation) use ($slotStart, $slotEnd) {
                $reservationStart = Carbon::parse($reservation->start_time)->format('H:i:s');
                $reservationEnd = Carbon::parse($reservation->end_time)->format('H:i:s');

                return (
                    ($reservationStart < $slotEnd && $reservationEnd > $slotStart)
                );
            })->isNotEmpty();

            if (!$isBooked) {
                $availableSlots[] = $slotStart; // حفظ الوقت المتاح فقط
            }
        }
    }

    return $availableSlots;
}

    // public function viewAvailableTimes5($placeId, $date) {

    //     $date = Carbon::parse($date)->toDateString();
    //     $dayName = Carbon::parse($date)->format('D');
    //     $availableTimes = AvailableTime::where('place_id', $placeId)->where('is_active', 1)->where('day', $dayName)->get();

    //     $reservations = Reservation::where('place_id', $placeId)
    //         ->whereDate('date_and_time', $date)
    //         ->get();

    //     $availableSlots = [];

    //     foreach ($availableTimes as $availableTime) {
    //         $startTime = Carbon::parse($availableTime->from_time);
    //         $endTime = Carbon::parse($availableTime->to_time);

    //         for ($time = $startTime->copy(); $time < $endTime; $time->addHour()) {
    //             $slotStart = $time->format('H:i:s');
    //             $slotEnd = $time->copy()->addHour()->format('H:i:s');

    //             $isBooked = $reservations->filter(function ($reservation) use ($slotStart, $slotEnd) {
    //                 $reservationStart = Carbon::parse($reservation->start_time)->format('H:i:s');
    //                 $reservationEnd = Carbon::parse($reservation->end_time)->format('Y-m-d H:i:s');

    //                 return (
    //                     ($reservationStart < $slotEnd && $reservationEnd > $slotStart)
    //                 );
    //             })->isNotEmpty();

    //             if (!$isBooked) {
    //                 $availableSlots[$availableTime->day][] = [
    //                     'from_time' => $slotStart,
    //                     'to_time' => $slotEnd,
    //                 ];
    //             }
    //         }
    //     }

    //     $formattedAvailableSlots = [];
    //     foreach ($availableSlots as $day => $slots) {
    //         $formattedAvailableSlots[$day] = [];
    //         foreach ($slots as $slot) {
    //             $formattedAvailableSlots[$day][] = $slot['from_time'] . ' - ' . $slot['to_time'];
    //             $times[]= $slot['from_time'];
    //             $times[]=$slot['to_time'];
    //         }
    //     }

    //     $allSlotsBooked = empty($formattedAvailableSlots);
    //     $message = $allSlotsBooked ? 'No available times for this date.' : $date;
    //     $day1=$day;

    //     return [
    //         'available_times' => $formattedAvailableSlots,
    //         'message' => $message,
    //     ];
    // }


    public function viewAvailableTimes5($placeId, $date) {

        $date = Carbon::parse($date)->toDateString();
        $dayName = Carbon::parse($date)->format('D');
        $availableTimes = AvailableTime::where('place_id', $placeId)
                                       ->where('is_active', 1)
                                       ->where('day', $dayName)
                                       ->get();

        $reservations = Reservation::where('place_id', $placeId)
                                   ->whereDate('date_and_time', $date)
                                   ->get();

        $availableSlots = [];

        foreach ($availableTimes as $availableTime) {
            $startTime = Carbon::parse($availableTime->from_time);
            $endTime = Carbon::parse($availableTime->to_time);

            while ($startTime < $endTime) {
                $slotStart = $startTime->format('H:i:s');
                $slotEnd = $startTime->copy()->addHour()->format('H:i:s');

                $isBooked = $reservations->filter(function ($reservation) use ($slotStart, $slotEnd) {
                    $reservationStart = Carbon::parse($reservation->start_time)->format('H:i:s');
                    $reservationEnd = Carbon::parse($reservation->end_time)->format('H:i:s');

                    return (
                        ($reservationStart < $slotEnd && $reservationEnd > $slotStart)
                    );
                })->isNotEmpty();

                if (!$isBooked) {
                    $availableSlots[] = [
                        'from_time' => $slotStart,
                        'to_time' => $slotEnd,
                    ];
                }

                $startTime->addHour();
            }
        }

        $allSlotsBooked = empty($availableSlots);
        $message = $allSlotsBooked ? 'No available times for this date.' : $date;

        return [
            'available_times' => $availableSlots,
            'message' => $message,
        ];
    }






    public function store($validatedData)
{
    DB::beginTransaction();

    try {
        $place = Place::findOrFail($validatedData['place_id']);
        if($place->day_hour=='HOURS'){
        $availableTimes = $this->viewAvailableTimes($validatedData['place_id'], $validatedData['date_and_time']);

        $dayName = Carbon::parse($validatedData['date_and_time'])->format('D');

        $startTime = Carbon::parse($validatedData['start_time']);
        $endTime = Carbon::parse($validatedData['end_time']);
        $jana = [];
        $jana[] = $startTime->copy()->format('H:i:s');
        if($startTime->copy()->addHour()->format('H:i:s') != $endTime->copy()->format('H:i:s')){
            for ($time = $startTime->copy(); $time < $endTime->format('H:i:s'); $time->addHour()) {
                $slotStart = $time->copy()->addHour()->format('H:i:s');
                if($slotStart != $endTime->copy()->format('H:i:s')){
                    $jana[] = $slotStart;
                }
            }
        }


        $interval = $startTime->diffInMinutes($endTime->copy()->format('H:i:s')) / 60;

        $totalPrice = $place->price_per_hour * $interval;

        if (isset($validatedData['extensions'])) {
            foreach ($validatedData['extensions'] as $extensionId) {
                $extension = Extension::findOrFail($extensionId);
                if ($extension->place_id != $validatedData['place_id']) {
                    DB::rollBack();
                    return response()->json(['message' => "Extension ID $extensionId does not belong to the selected place."], 400);
                }
                $totalPrice += $extension->price;
            }
        }

        $user = User::findOrFail(Auth::user()->id);
        if($user->balance < $totalPrice){
            DB::rollBack();
            return response()->json(['message' => "YOU DON'T HAVE ENOUGH MONEY!"], 400);
        }
        $booked=true;

        foreach($jana as $j){
            if (!in_array($j, $availableTimes)) {
                $booked=false;
            }
        }
        if(!$booked || Carbon::parse($validatedData['start_time'])->format('H:i:s') > Carbon::parse($validatedData['end_time'])->format('H:i:s')){
             DB::rollBack();
            return response()->json(['message' =>"NOT Available Time !"], 404);
         }

        $reservation = Reservation::create([
            'place_id' => $validatedData['place_id'],
            'user_id' => $user->id,
            'type_id' => $validatedData['type_id'],
            'total_price' => $totalPrice,
            'date_and_time' => $validatedData['date_and_time'],
            'day' => $dayName,
            'start_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('Y-m-d H:i:s'),
        ]);

        if (isset($validatedData['extensions'])) {
            foreach ($validatedData['extensions'] as $extensionId) {
                ExtensionReservation::create([
                    'reservation_id' => $reservation->id,
                    'extension_id' => $extensionId,
                ]);
            }
        }

        $user->balance -= $totalPrice;
        $user->save();
        $totalPriceinvestor=$totalPrice-($totalPrice *0.01);
        $owner = User::findOrFail($place->owner_id);
        $owner->balance+=$totalPriceinvestor;
        $owner->save();
        $admin = User::query()->where('role',"ADMIN")->first();
        $admin->balance +=$totalPrice *0.01;
        $admin->save();

        DB::commit();
    }
    else{
    return response()->json(['message' => "the plasc is not hour Type !"]);
    }
        return response()->json($reservation, 201);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => $e->getMessage()], 500);
    }
}
public function makeDay($validatedData){
    $place = Place::findOrFail($validatedData['place_id']);
    if($place->day_hour=='DAYS'){
        $date = Carbon::parse($validatedData['date_and_time']);
        $numOFDay = $validatedData['numOfDay'];
        $endTime = $date->copy()->addDays($numOFDay - 1)->setTime(10, 0, 0)->format('Y-m-d H:i:s');

        $availableDays = $this->viewAvailableDay($validatedData['place_id']);
        $bookedDays = $this->viewBookedDays($validatedData['place_id']);

        $totalPrice = $place->price_per_hour * 24 * $numOFDay;

        $requestedDays = [];

        for ($i = 0; $i < $numOFDay; $i++) {
            $currentDay = $date->copy()->addDays($i);
            $dayName = $currentDay->format('D');
            $requestedDays[] = [
                'date' => $currentDay->format('Y-m-d'),
                'dayName' => $dayName,
            ];
        }

        // التحقق من توافر الأيام المطلوبة وعدم وجود حجوزات سابقة
        foreach ($requestedDays as $day) {
            if (!in_array($day['dayName'], $availableDays)) {
                return response()->json(['message' => "The day {$day['dayName']} is not available For this Place!"], 404);
            }
            if (in_array($day['date'], $bookedDays)) {
                return response()->json(['message' => "The day {$day['date']} is not available!"], 404);
            }
        }

        if (isset($validatedData['extensions'])) {
            foreach ($validatedData['extensions'] as $extensionId) {
                $extension = Extension::findOrFail($extensionId);
                if ($extension->place_id != $validatedData['place_id']) {
                    return response()->json(['message' => "Extension ID $extensionId does not belong to the selected place."], 400);
                }
                $totalPrice += $extension->price;
            }
        }
        return $totalPrice;
    }
    else{
        return response()->json(['message' => "the plasc is not day Type !"]);
    }
}
public function makeHour($validatedData)
{

    $place = Place::findOrFail($validatedData['place_id']);
    if($place->day_hour == 'HOURS'){
    $availableTimes = $this->viewAvailableTimes($validatedData['place_id'], $validatedData['date_and_time']);

    $startTime = Carbon::parse($validatedData['start_time']);
    $endTime = Carbon::parse($validatedData['end_time']);
    $jana = [];
    $jana[] = $startTime->copy()->format('H:i:s');
    if($startTime->copy()->addHour()->format('H:i:s') != $endTime->copy()->format('H:i:s')){
        for ($time = $startTime->copy(); $time < $endTime->format('H:i:s'); $time->addHour()) {
            $slotStart = $time->copy()->addHour()->format('H:i:s');
            if($slotStart != $endTime->copy()->format('H:i:s')){
                $jana[] = $slotStart;
            }
        }
    }

    $booked=true;

    foreach($jana as $j){
        if (!in_array($j, $availableTimes)) {
            $booked=false;
        }
    }
    if(!$booked || Carbon::parse($validatedData['start_time'])->format('H:i:s') > Carbon::parse($validatedData['end_time'])->format('H:i:s')){
        return response()->json(['message' => "The Time Is Not Available !"], 404);
    }

    $interval = $startTime->diffInMinutes($endTime->copy()->format('H:i:s')) / 60;

    $totalPrice = $place->price_per_hour * $interval;

    $extensions = [];
    if (isset($validatedData['extensions'])) {
        foreach ($validatedData['extensions'] as $extensionId) {
            $extension = Extension::findOrFail($extensionId);
            if ($extension->place_id != $validatedData['place_id']) {
                DB::rollBack();
                return response()->json(['message' => "Extension ID $extensionId does not belong to the selected place."], 400);
            }
            $totalPrice += $extension->price;
            $extensions = $extension->id;
        }
    }
    $response = [
        'total_price' => $totalPrice,
        'place_id' => $place->id,
        'type_id' => intVal($validatedData['type_id']),
        'date_and_time' => $validatedData['date_and_time'],
        'start_time' => $startTime->format('H:i:s'),
        'end_time' => $endTime->format('Y-m-d H:i:s'),
        'extensions' => $extensions
    ];

    return $response;
 }
    else{
        return response()->json(['message' => "the plasc is not hour Type !"]);
    }
}





public function viewAvailableDay($placeId)
{
    // جلب الأوقات المتاحة الخاصة بالمكان المحدد والتي تكون نشطة
    $availableDays = AvailableTime::where('place_id', $placeId)->where('is_active', 1)->pluck('day')->toArray();

    return $availableDays;
}

public function viewBookedDays($placeId)
{
    // جلب الحجوزات الخاصة بالمكان المحدد
    $reservations = Reservation::where('place_id', $placeId)->get();

    $bookedDays = []; // مصفوفة لتخزين الأيام المحجوزة

    foreach ($reservations as $reservation) {
        $bookedDays[] = Carbon::parse($reservation->date_and_time)->format('Y-m-d');
    }

    return $bookedDays;
}



public function storeFromDay($validatedData)
{

    DB::beginTransaction();

    try {
        $place = Place::findOrFail($validatedData['place_id']);
        if($place->day_hour == 'DAYS'){
        $date = Carbon::parse($validatedData['date_and_time']);
        $numOFDay = $validatedData['numOfDay'];
        $endTime = $date->copy()->addDays($numOFDay - 1)->setTime(10, 0, 0)->format('Y-m-d H:i:s');

        $availableDays = $this->viewAvailableDay($validatedData['place_id']);
        $bookedDays = $this->viewBookedDays($validatedData['place_id']);

        $totalPrice = $place->price_per_hour * 24 * $numOFDay;

        $requestedDays = [];

        for ($i = 0; $i < $numOFDay; $i++) {
            $currentDay = $date->copy()->addDays($i);
            $dayName = $currentDay->format('D');
            $requestedDays[] = [
                'date' => $currentDay->format('Y-m-d'),
                'dayName' => $dayName,
            ];
        }

        // التحقق من توافر الأيام المطلوبة وعدم وجود حجوزات سابقة
        foreach ($requestedDays as $day) {
            if (!in_array($day['dayName'], $availableDays)) {
                DB::rollBack();
                return response()->json(['message' => "The day {$day['dayName']} is not available For this Place!"], 404);
            }
            if (in_array($day['date'], $bookedDays)) {
                DB::rollBack();
                return response()->json(['message' => "The day {$day['date']} is not available!"], 404);
            }
        }

        if (isset($validatedData['extensions'])) {
            foreach ($validatedData['extensions'] as $extensionId) {
                $extension = Extension::findOrFail($extensionId);
                if ($extension->place_id != $validatedData['place_id']) {
                    DB::rollBack();
                    return response()->json(['message' => "Extension ID $extensionId does not belong to the selected place."], 400);
                }
                $totalPrice += $extension->price;
            }
        }

        $user = User::findOrFail(Auth::user()->id);
        if ($user->balance < $totalPrice) {
            DB::rollBack();
            return response()->json(['message' => "YOU DON'T HAVE ENOUGH MONEY!"], 400);
        }

        // إنشاء حجز واحد للفترة الكاملة
        $reservation = Reservation::create([
            'place_id' => $validatedData['place_id'],
            'user_id' => $user->id,
            'type_id' => $validatedData['type_id'],
            'total_price' => $totalPrice,
            'date_and_time' => $validatedData['date_and_time'],
            'start_time' => Carbon::parse('09:15:00')->format('H:i:s'),
            'end_time' => $endTime,
            'day' => $date->format('D'), // يمكنك تعديل هذا حسب الاحتياج
        ]);

        if (isset($validatedData['extensions'])) {
            foreach ($validatedData['extensions'] as $extensionId) {
                ExtensionReservation::create([
                    'reservation_id' => $reservation->id,
                    'extension_id' => $extensionId,
                ]);
            }
        }

        $user->balance -= $totalPrice;
        $user->save();
        $totalPriceinvestor=$totalPrice-($totalPrice *0.01);
        $owner = User::findOrFail($place->owner_id);
        $owner->balance+=$totalPriceinvestor;
        $owner->save();
        $admin = User::query()->where('role',"ADMIN")->first();
        $admin->balance +=$totalPrice *0.01;
        $admin->save();
        DB::commit();
    }
    else{
        return response()->json(['message' => "the plasc is not day Type !"]);

    }
        return response()->json($reservation, 201);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => $e->getMessage()], 500);
    }



}

public function getMyReservation() {
    $user = Auth::user();

    if (!$user) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $reservations = Reservation::with('extensions')->where('user_id', $user->id)->get();

    return $reservations;
}

public function getPlaceReservation($validatedData){

    $reservations = Reservation::with('extensions')->where('place_id',$validatedData['id'])->get();

     return $reservations;
}
}




