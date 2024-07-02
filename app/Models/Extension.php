<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Extension extends GenericModel
{
    protected $table = 'extensions';



    protected $fillable = [
		'name',
		'place_id',
		'description',
		'price',
	];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(ExtensionReservation::class, 'extension_id', 'id');
    }
}

