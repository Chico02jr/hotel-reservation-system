@extends('layouts.app')
@section('content')
<div class='container' style='max-width:700px;margin:50px auto;'><h2>Chambre {{ $chambre->numero }}</h2><p>Type : {{ $chambre->type }}</p><p>Prix : {{ number_format($chambre->prix_par_nuit) }} FCFA / nuit</p><p>Capacite : {{ $chambre->capacite }} personne(s)</p><p>{{ $chambre->description }}</p><a href='/reservations/create/{{ $chambre->id }}' style='background:#c9a84c;color:white;padding:10px 20px;border-radius:5px;text-decoration:none;'>Reserver cette chambre</a></div>
@endsection