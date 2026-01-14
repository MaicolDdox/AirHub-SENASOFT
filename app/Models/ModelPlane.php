<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelPlane extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'marca',
        'capacidad',
    ];

    //Relacion de la tabla Flight
    public function flights(): HasMany
    {
       return $this->hasMany(Flight::class);
    }
}
