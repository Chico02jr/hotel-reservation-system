@extends('layouts.app')

@section('title', 'Reserver - LuxHotel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <h3 class="fw-bold mb-4" style="color: #1a1a2e;">
                        <i class="fas fa-calendar-check me-2" style="color: #c9a84c;"></i>
                        Reserver - Chambre {{ $chambre->numero }}
                    </h3>

                    <div class="alert" style="background-color: #f8f3e3; border-left: 4px solid #c9a84c;">
                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted">Type</small>
                                <p class="fw-bold mb-0">{{ ucfirst($chambre->type) }}</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Capacite</small>
                                <p class="fw-bold mb-0">{{ $chambre->capacite }} personnes</p>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted">Prix par nuit</small>
                                <p class="fw-bold mb-0" style="color: #c9a84c;">
                                    {{ number_format($chambre->prix_par_nuit, 0) }} FCFA
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="/reservations" method="POST">
                        @csrf
                        <input type="hidden" name="chambre_id" value="{{ $chambre->id }}">

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Date d'arrivee</label>
                                <input type="date" name="date_arrivee" id="date_arrivee"
                                    class="form-control" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Date de depart</label>
                                <input type="date" name="date_depart" id="date_depart"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nombre de personnes</label>
                            <input type="number" name="nombre_personnes" id="nombre_personnes"
                                class="form-control" min="1" max="{{ $chambre->capacite }}" required>
                            <small class="text-muted">Maximum {{ $chambre->capacite }} personnes</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Demandes speciales</label>
                            <textarea name="demandes_speciales" class="form-control" rows="3"
                                placeholder="Ex: chambre non-fumeur, vue sur mer..."></textarea>
                        </div>

                        {{-- Calcul du prix --}}
                        <div id="prix_calcul" class="card border-0 mb-4" style="background-color: #f8f3e3; display:none;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Prix par nuit</span>
                                    <span>{{ number_format($chambre->prix_par_nuit, 0) }} FCFA</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Nombre de nuits</span>
                                    <span id="nb_nuits">0</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between fw-bold fs-5">
                                    <span>Total</span>
                                    <span id="prix_total" style="color: #c9a84c;">0 FCFA</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gold w-100 py-2 fw-bold fs-5">
                            <i class="fas fa-check me-2"></i>Confirmer la reservation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const prixParNuit = {{ $chambre->prix_par_nuit }};

    const dateArrivee = document.getElementById('date_arrivee');
    const dateDepart  = document.getElementById('date_depart');
    const prixCalcul  = document.getElementById('prix_calcul');
    const nbNuits     = document.getElementById('nb_nuits');
    const prixTotal   = document.getElementById('prix_total');

    function calculerPrix() {
        const arrivee = new Date(dateArrivee.value);
        const depart  = new Date(dateDepart.value);

        if (dateArrivee.value && dateDepart.value && depart > arrivee) {
            const nuits = Math.round((depart - arrivee) / (1000 * 60 * 60 * 24));
            const total = nuits * prixParNuit;

            nbNuits.textContent   = nuits + ' nuit(s)';
            prixTotal.textContent = total.toLocaleString() + ' FCFA';
            prixCalcul.style.display = 'block';

            // Mettre la date min du depart
            dateDepart.min = dateArrivee.value;
        } else {
            prixCalcul.style.display = 'none';
        }
    }

    dateArrivee.addEventListener('change', calculerPrix);
    dateDepart.addEventListener('change', calculerPrix);
</script>
@endsection