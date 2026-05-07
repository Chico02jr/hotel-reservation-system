<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = [
        'reservation_id',
        'montant',
        'methode',
        'statut',
        'reference',
        'paye_le'
    ];

    // Un paiement appartient à une réservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}