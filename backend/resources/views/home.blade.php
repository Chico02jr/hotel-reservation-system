@extends('layouts.app')

@section('title', 'Accueil - LuxHotel')

@section('content')

<div style="background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600') center/cover; min-height: 90vh; display: flex; align-items: center;">
    <div class="container text-white text-center">
        <h1 class="display-3 fw-bold mb-3">Bienvenue au <span style="color: #c9a84c;">LuxHotel</span></h1>
        <p class="lead mb-4">Une experience unique de luxe et de confort</p>
        <a href="/chambres" class="btn btn-gold btn-lg px-5 py-3">
            <i class="fas fa-bed me-2"></i>Voir nos chambres
        </a>
    </div>
</div>

<div class="container py-5">
    <h2 class="text-center fw-bold mb-5">Nos Services</h2>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow text-center p-4">
                <i class="fas fa-wifi fa-3x mb-3" style="color: #c9a84c;"></i>
                <h5>WiFi Gratuit</h5>
                <p class="text-muted">Connexion haut debit dans tout l'hotel</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow text-center p-4">
                <i class="fas fa-swimming-pool fa-3x mb-3" style="color: #c9a84c;"></i>
                <h5>Piscine et Spa</h5>
                <p class="text-muted">Detendez-vous dans notre espace bien-etre</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow text-center p-4">
                <i class="fas fa-utensils fa-3x mb-3" style="color: #c9a84c;"></i>
                <h5>Restaurant Gastronomique</h5>
                <p class="text-muted">Savourez notre cuisine raffinee</p>
            </div>
        </div>
    </div>
</div>

<div style="background-color: #1a1a2e;" class="py-5 text-white text-center">
    <div class="container">
        <h3 class="fw-bold mb-3">Pret a reserver votre sejour ?</h3>
        <p class="mb-4">Profitez de nos offres exclusives et reservez des maintenant</p>
        <a href="/register" cla