@extends('layouts.app')

@section('content')
<div class="container" style="max-width:600px; margin:50px auto;">
    <h2>Réserver la chambre {{ $chambre->numero }}</h2>
    <p>Type : {{ $chambre->type }} | Prix : {{ number_format($chambre->prix_par_nuit) }} FCFA / nuit</p>

    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf

        <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">

        <div style="margin-bottom:15px;">
            <label>Date d'arrivée</label>
            <input type="date" name="date_arrivee" class="form-control" required>
        </div>

        <div style="margin-bottom:15px;">
            <label>Date de départ</label>
            <input type="date" name="date_depart" class="form-control" required>
        </div>

        @if($errors->any())
            <div style="color:red;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Confirmer la réservation</button>
    </form>
</div>
@endsection