<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'nom',
        'prix',
        'description'
    ];

    // Un service appartient à plusieurs réservations
    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_service')
                    ->withPivot('quantite');
    }
}