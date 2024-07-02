<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\RateWithComment;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Place extends GenericModel
{
    protected $table = 'places';


    protected $fillable = [
		'name',
		'owner_id',
		'maximum_capacity',
		'price_per_hour',
		'space',
		'license',
		'category_id',
		'status',
	];


    public function extensions(): HasMany
    {
        return $this->hasMany(Extension::class, 'place_id', 'id');
    }

    public function feedBacks(): HasMany
    {
        return $this->hasMany(FeedBack::class, 'place_id', 'id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class, 'place_id', 'id');
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'place_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function rateWithComments(): HasMany
    {
        return $this->hasMany(RateWithComment::class, 'place_id', 'id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'place_id', 'id');
    }

    public function types(): HasMany
    {
        return $this->hasMany(Type::class, 'place_id', 'id');
    }

    public function availableTimes(): HasMany
    {
        return $this->hasMany(AvailableTime::class, 'place_id', 'id');
    }

    public function favouritedBy()
    {
        return $this->belongsToMany(User::class, 'favourites', 'place_id', 'user_id');
    }

}



