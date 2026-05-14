@extends('layouts.app')

@section('content')
@if(session('success'))
    <div style="background:#d4edda; color:#155724; padding:15px; margin:20px; border-radius:5px;">
        ✅ {{ session('success') }}
    </div>
@endif
<div class="container" style="max-width:1100px; margin:50px auto;">
    <h2 style="text-align:center; margin-bottom:30px;">Nos Chambres</h2>

    <div style="display:flex; gap:20px; flex-wrap:wrap; justify-content:center;">
        @forelse($chambres as $chambre)
        <div style="border:1px solid #ddd; border-radius:10px; padding:20px; width:300px;">
            <h3>Chambre {{ $chambre->numero }}</h3>
            <p><strong>Type :</strong> {{ $chambre->type }}</p>
            <p><strong>Prix :</strong> {{ number_format($chambre->prix_par_nuit) }} FCFA / nuit</p>
            <p><strong>Capacité :</strong> {{ $chambre->capacite }} personne(s)</p>
            <p>{{ $chambre->description }}</p>
            <a href="{{ route('reservations.create', $chambre->id) }}" 
               style="background:#c9a84c; color:white; padding:10px 20px; border-radius:5px; text-decoration:none;">
               Voir et réserver
            </a>
        </div>
        @empty
            <p>Aucune chambre disponible.</p>
        @endforelse
    </div>
</div>
@endsection