@extends('layouts.app')
@section('content')
<div class='container' style='max-width:900px;margin:50px auto;'><h2>Mes Reservations</h2>@forelse($reservations as $r)<div style='border:1px solid #ddd;border-radius:10px;padding:20px;margin-bottom:15px;'><h4>Chambre {{ $r->chambre->numero ?? 'N/A' }}</h4><p>Arrivee : {{ $r->date_arrivee }}</p><p>Depart : {{ $r->date_depart }}</p><p>Prix : {{ number_format($r->prix_total) }} FCFA</p><p>Statut : {{ $r->statut }}</p></div>@empty<p>Aucune reservation.</p>@endforelse</div>
@endsection