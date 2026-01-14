<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'airline',
    ];

    //Relacion de la tabla Flight
    public function flights(): HasMany
    {
       return $this->hasMany(Flight::class);
    }
}
