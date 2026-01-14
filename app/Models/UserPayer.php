<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserPayer extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'user_id',
        'flight_id',
        'rol',
    ];

    //Relacion tabla Users
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relacion tabla vuelos
    public function flight():BelongsTo
    {
        return $this->belongsTo(Flight::class);
    }

    //Relacion con la tabla user_passengers
    public function user_passengers(): HasMany
    {
        return $this->hasMany(UserPassenger::class);
    }

    //Relacion para la tabla Positions
    public function positions():HasMany
    {
        return $this->hasMany(Position::class);
    }

    //Relacion para la tabla Pay
    public function pays():HasMany
    {
        return $this->hasMany(Pay::class);
    }

    //Relacion ticket
    public function tickets():HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
