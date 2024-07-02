<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class RateWithComment extends GenericModel
{
    protected $table = 'rate_with_comments';



    protected $fillable = [
		'user_id',
		'place_id',
		'text',
		'rate',
	];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function place(): BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
}

