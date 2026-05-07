<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'chambre_id',
        'date_arrivee',
        'date_depart',
        'nombre_personnes',
        'prix_total',
        'statut',
        'demandes_speciales'
    ];

    // Une réservation appartient à un client
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une réservation appartient à une chambre
    public function chambre()
    {
        return $this->belongsTo(Chambre::class);
    }

    // Une réservation a un paiement
    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }

    // Une réservation a plusieurs services
    public function services()
    {
        return $this->belongsToMany(Service::class, 'reservation_service')
                    ->withPivot('quantite');
    }
}