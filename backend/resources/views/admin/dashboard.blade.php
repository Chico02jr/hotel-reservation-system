@extends('layouts.app')

@section('title', 'Dashboard Admin - LuxHotel')

@section('content')
<div class="container-fluid py-4">
    <div class="row">

        {{-- Sidebar --}}
        <div class="col-md-2" style="background-color: #1a1a2e; min-height: 100vh;">
            <div class="py-4 px-2">
                <h5 class="text-center fw-bold mb-4" style="color: #c9a84c;">
                    <i class="fas fa-hotel me-2"></i>Admin
                </h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="/admin/dashboard" class="nav-link" style="color: #c9a84c;">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/admin/chambres" class="nav-link" style="color: #aaa;">
                            <i class="fas fa-bed me-2"></i>Chambres
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/admin/reservations" class="nav-link" style="color: #aaa;">
                            <i class="fas fa-calendar-check me-2"></i>Reservations
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/admin/paiements" class="nav-link" style="color: #aaa;">
                            <i class="fas fa-money-bill me-2"></i>Paiements
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="/admin/clients" class="nav-link" style="color: #aaa;">
                            <i class="fas fa-users me-2"></i>Clients
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Contenu --}}
        <div class="col-md-10 py-4 px-5">
            <h3 class="fw-bold mb-4" style="color: #1a1a2e;">
                <i class="fas fa-tachometer-alt me-2" style="color: #c9a84c;"></i>Tableau de bord
            </h3>

            {{-- Statistiques --}}
            <div class="row g-4 mb-5">
                <div class="col-md-3">
                    <div class="card border-0 shadow text-white" style="background-color: #1a1a2e;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 small">Total Chambres</p>
                                    <h3 class="fw-bold">{{ $totalChambres }}</h3>
                                </div>
                                <i class="fas fa-bed fa-2x" style="color: #c9a84c;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow text-white" style="background-color: #c9a84c;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 small">Reservations</p>
                                    <h3 class="fw-bold">{{ $totalReservations }}</h3>
                                </div>
                                <i class="fas fa-calendar-check fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow text-white" style="background-color: #28a745;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 small">Clients</p>
                                    <h3 class="fw-bold">{{ $totalClients }}</h3>
                                </div>
                                <i class="fas fa-users fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow text-white" style="background-color: #17a2b8;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 small">Revenus</p>
                                    <h3 class="fw-bold">{{ number_format($totalRevenus, 0) }}</h3>
                                </div>
                                <i class="fas fa-money-bill fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Graphiques --}}
            <div class="row g-4 mb-5">
                <div class="col-md-8">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-white py-3">
                            <h5 class="fw-bold mb-0" style="color: #1a1a2e;">
                                <i class="fas fa-chart-line me-2" style="color: #c9a84c;"></i>
                                Reservations par mois
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="reservationsChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow">
                        <div class="card-header bg-white py-3">
                            <h5 class="fw-bold mb-0" style="color: #1a1a2e;">
                                <i class="fas fa-chart-pie me-2" style="color: #c9a84c;"></i>
                                Types de chambres
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="chambresChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Dernieres reservations --}}
            <div class="card border-0 shadow">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0" style="color: #1a1a2e;">
                        <i class="fas fa-list me-2" style="color: #c9a84c;"></i>Dernieres Reservations
                    </h5>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th class="px-4 py-3">Client</th>
                                <th>Chambre</th>
                                <th>Arrivee</th>
                                <th>Depart</th>
                                <th>Prix</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dernieresReservations as $reservation)
                            <tr>
                                <td class="px-4">{{ $reservation->user->name }}</td>
                                <td>{{ $reservation->chambre->numero }}</td>
                                <td>{{ $reservation->date_arrivee }}</td>
                                <td>{{ $reservation->date_depart }}</td>
                                <td>{{ number_format($reservation->prix_total, 0) }} FCFA</td>
                                <td>
                                    @php
                                        $badges = [
                                            'en_attente' => 'warning',
                                            'confirmee'  => 'success',
                                            'annulee'    => 'danger',
                                            'terminee'   => 'secondary'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $badges[$reservation->statut] }}">
                                        {{ ucfirst($reservation->statut) }}
                                    </span>
                                </td>
                                <td>
                                    @if($reservation->statut === 'en_attente')
                                    <form action="/admin/reservations/{{ $reservation->id }}/confirmer" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="/admin/reservations/{{ $reservation->id }}/annuler" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Aucune reservation pour le moment
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique reservations par mois
    const ctx1 = document.getElementById('reservationsChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Reservations',
                data: @json($reservationsParMois ?? [0,0,0,0,0,0,0,0,0,0,0,0]),
                borderColor: '#c9a84c',
                backgroundColor: 'rgba(201,168,76,0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Graphique types de chambres
    const ctx2 = document.getElementById('chambresChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Simple', 'Double', 'Suite', 'Familiale'],
            datasets: [{
                data: @json($chambresParType ?? [0,0,0,0]),
                backgroundColor: ['#1a1a2e', '#c9a84c', '#28a745', '#17a2b8'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection