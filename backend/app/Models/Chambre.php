<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model
{
    protected $fillable = [
        'numero',
        'type',
        'prix_par_nuit',
        'capacite',
        'description',
        'statut',
        'image'
    ];

    // Une chambre a plusieurs réservations
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Une chambre a plusieurs services
    public function services()
    {
        return $this->belongsToMany(Service::class, 'reservation_service');
    }
}