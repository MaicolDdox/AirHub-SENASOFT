<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'origin_id',
        'destinie_id',
        'model_plane_id',
        'airline_id',
        'positionValue',
        'dateHour',
        'userPassenger',
        'cantCupos',
        'estado',
    ];

    //Relacion on Origin
    public function origin(): BelongsTo
    {
        return $this->belongsTo(Origin::class);
    }

    //Relacion con Destinie
    public function destinie(): BelongsTo
    {
        return $this->belongsTo(Destinie::class);
    }

    //Relacion con modelo de avion
    public function model_plane(): BelongsTo
    {
        return $this->belongsTo(ModelPlane::class);
    }

    //Relacion con la aeorilinea
    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    //Relacion con la tabla user_payers
    public function user_payers(): HasMany
    {
        return $this->hasMany(UserPayer::class);
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
