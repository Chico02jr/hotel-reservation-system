@extends('layouts.app')

@section('title', 'Nos Chambres — LuxHôtel')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-center mb-2" style="color: #1a1a2e;">Nos Chambres</h2>
    <p class="text-center text-muted mb-5">Choisissez la chambre qui vous convient</p>

    {{-- Filtres --}}
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body p-4">
            <form method="GET" action="/chambres">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Type de chambre</label>
                        <select name="type" class="form-select">
                            <option value="">Tous les types</option>
                            <option value="simple">Simple</option>
                            <option value="double">Double</option>
                            <option value="suite">Suite</option>
                            <option value="familiale">Familiale</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Arrivée</label>
                        <input type="date" name="date_arrivee" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Départ</label>
                        <input type="date" name="date_depart" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-gold w-100 py-2">
                            <i class="fas fa-search me-2"></i>Rechercher
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Liste des chambres --}}
    <div class="row g-4">
        @forelse($chambres as $chambre)
        <div class="col-md-4">
            <div class="card border-0 shadow h-100">
                <img src="{{ $chambre->image ?? 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600' }}"
                     class="card-img-top" style="height: 220px; object-fit: cover;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold mb-0">Chambre {{ $chambre->numero }}</h5>
                        <span class="badge" style="background-color: #c9a84c;">{{ ucfirst($chambre->type) }}</span>
                    </div>
                    <p class="text-muted small">{{ $chambre->description }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <i class="fas fa-user-friends me-1" style="color: #c9a84c;"></i>
                            <small>{{ $chambre->capacite }} personnes</small>
                        </div>
                        <div class="fw-bold" style="color: #1a1a2e;">
                            {{ number_format($chambre->prix_par_nuit, 0) }} FCFA / nuit
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-3">
                    <a href="/chambres/{{ $chambre->id }}" class="btn btn-gold w-100">
                        <i class="fas fa-eye me-2"></i>Voir & Réserver
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-bed fa-4x text-muted mb-3"></i>
            <h5 class="text-muted">Aucune chambre disponible</h5>
        </div>
        @endforelse
    </div>
</div>
@endsection