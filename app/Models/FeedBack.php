<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FeedBack extends GenericModel
{
    protected $table = 'feed_backs';



    protected $fillable = [
		'user_id',
		'place_id',
		'text',
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

