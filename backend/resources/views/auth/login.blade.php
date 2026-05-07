@extends('layouts.app')

@section('title', 'Connexion - LuxHotel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <h3 class="fw-bold text-center mb-4" style="color: #1a1a2e;">
                        <i class="fas fa-sign-in-alt me-2" style="color: #c9a84c;"></i>Connexion
                    </h3>

                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                        </div>
                        <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
                            Se connecter
                        </button>
                    </form>

                    <hr>
                    <p class="text-center mb-0">
                        Pas encore de compte ?
                        <a href="/register" style="color: #c9a84c;">S'inscrire</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection