<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ExtensionReservation extends GenericModel
{
    protected $table = 'extension_reservations';



    protected $fillable = [
		'reservation_id',
		'extension_id',
	];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }

    public function extension(): BelongsTo
    {
        return $this->belongsTo(Extension::class, 'extension_id', 'id');
    }
}

