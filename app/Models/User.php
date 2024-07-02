<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
		'name',
		'email',
		'password',
		'user_name',
		'role',
		'balance',
	];

    public function places(){
        return $this->hasMany(Place::class,'owner_id');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class,'user_id');
    }

    public function ads(){
        return $this->hasMany(Ad::class,'user_id');
    }

    public function rateWithComments(){
        return $this->hasMany(RateWithComment::class,'user_id');
    }

    public function favourites()
    {
        return $this->belongsToMany(Place::class, 'favourites', 'user_id', 'place_id');
    }

    public function feedBacks(){
        return $this->hasMany(FeedBack::class,'user_id');
    }

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}





