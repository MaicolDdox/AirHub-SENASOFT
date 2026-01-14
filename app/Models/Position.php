<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_payer_id',
        'user_passenger_id',
        'flight_id',
        'seat_number',
        'estado',           
    ];

    //Relacion con la tabla user_payer
    public function user_payer():BelongsTo
    {
        return $this->belongsTo(UserPayer::class);
    }

    //Relacion con la tabla user_passenger
    public function user_passenger():BelongsTo
    {
        return $this->belongsTo(UserPassenger::class);
    }

    //Relacion con la tabla vuelos
    public function flight(): BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

}
