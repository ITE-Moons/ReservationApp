<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Ad extends GenericModel
{
    protected $table = 'ads';



    protected $fillable = [
		'user_id',
		'image',
		'description',
		'status',
	];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

