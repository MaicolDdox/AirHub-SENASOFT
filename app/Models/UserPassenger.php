<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserPassenger extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'flight_id',
        'user_payer_id',
        'first_name',
        'middle_name',
        'first_surname',
        'middle_surname',
        'fecha_nacimiento',
        'genero',
        'email',
        'type_document',
        'number_document',
        'number_phone',
    ];

    //Relacion de la tabla vuelo
    public function flight():BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    //Relacion de la tabla user_payers
    public function user_payer():BelongsTo
    {
        return $this->belongsTo(UserPayer::class);
    }

    //Relacion para la tabla Positions
    public function positions():HasMany
    {
        return $this->hasMany(Position::class);
    }
}
