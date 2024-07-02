<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Address extends GenericModel
{
    protected $table = 'addresses';



    protected $fillable = [
        'place_id',
		'goverment',
		'city',
		'area',
		'street',
	];


    public function address(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}

