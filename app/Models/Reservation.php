<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Reservation extends GenericModel
{
    protected $table = 'reservations';



    protected $fillable = [
		'place_id',
		'user_id',
		'type_id',
		'total_price',
		'date_and_time',
        'day',
        'start_time',
        'end_time',
	];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function extensions()
{
    return $this->hasManyThrough(
        Extension::class,
        ExtensionReservation::class,
        'reservation_id',
        'id',
        'id',
        'extension_id'
    );
}

}

