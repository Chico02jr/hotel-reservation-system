"" 
@extends('layouts.app')

@section('content')
<div class="container" style="max-width:900px; margin:50px auto;">
    <h2 style="margin-bottom:30px;">Mes Réservations</h2>

    @forelse($reservations as $reservation)
    <div style="border:1px solid #ddd; border-radius:10px; padding:20px; margin-bottom:15px;">
        <h4>Chambre {{ $reservation->chambre->numero ?? 'N/A' }}</h4>
        <p><strong>Arrivée :</strong> {{ $reservation->date_arrivee }}</p>
        <p><strong>Départ :</strong> {{ $reservation->date_depart }}</p>
        <p><strong>Prix total :</strong> {{ number_format($reservation->prix_total) }} FCFA</p>
        <p><strong>Statut :</strong> {{ $reservation->statut }}</p>
    </div>
    @empty
        <p>Aucune réservation pour le moment.</p>
    @endforelse
</div>
@endsection