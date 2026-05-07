@extends('layouts.app')

@section('title', 'Inscription - LuxHotel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-center mb-4" style="color: #1a1a2e;">
                        <i class="fas fa-user-plus me-2" style="color: #c9a84c;"></i>Creer un compte
                    </h3>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form action="/register" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nom complet</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Telephone</label>
                            <input type="tel" name="phone" class="form-control" value="{{ old('phone') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
                            S'inscrire
                        </button>
                    </form>

                    <hr>
                    <p class="text-center mb-0">
                        Deja un compte ?
                        <a href="/login" style="color: #c9a84c;">Se connecter</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection