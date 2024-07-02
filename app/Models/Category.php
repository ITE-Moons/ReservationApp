<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends GenericModel
{
    protected $table = 'categories';



    protected $fillable = [
		'name',
		'image',
	];

    public function places(): HasMany
    {
        return $this->hasMany(Place::class, 'category_id', 'id');
    }
}

