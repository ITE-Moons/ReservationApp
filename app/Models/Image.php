<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Image extends GenericModel
{
    protected $table = 'images';



    protected $fillable = [
		'image',
		'place_id',
	];

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}

