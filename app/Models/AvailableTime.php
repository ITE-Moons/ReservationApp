<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class AvailableTime extends GenericModel
{
    protected $table = 'available_times';



    protected $fillable = [
		'day',
		'from_time',
		'to_time',
		'is_Active',
		'place_id',
    ];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

}
