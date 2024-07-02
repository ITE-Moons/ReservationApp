<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Type extends GenericModel
{
    protected $table = 'types';



    protected $fillable = [
		'name',
		'place_id',
	];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'type_id', 'id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}

