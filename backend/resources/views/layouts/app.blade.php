<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LuxHotel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --primary: #1a1a2e; --gold: #c9a84c; }
        body {
            background-color: #f0f2f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main { flex: 1; }
        .navbar {
            background-color: var(--primary) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .navbar-brand { color: var(--gold) !important; }
        .nav-link { color: var(--gold) !important; }
        .nav-link:hover { color: white !important; }
        .btn-gold {
            background-color: var(--gold);
            color: white;
            border: none;
        }
        .btn-gold:hover { background-color: #b8943d; color: white; }
        footer {
            background-color: var(--primary);
            color: #aaa;
            text-align: center;
            padding: 20px;
        }
        .is-valid { border-color: #28a745 !important; }
        .is-invalid { border-color: #dc3545 !important; }
        .invalid-feedback { display: block; color: #dc3545; font-size: 0.85em; }
        .valid-feedback { display: block; color: #28a745; font-size: 0.85em; }
    </style>
    @yield('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="/">
                <i class="fas fa-hotel me-2"></i>LuxHotel
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars" style="color: var(--gold);"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/chambres">Chambres</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/reservations">Mes Reservations</a>
                        </li>
                        @if(Auth::user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/dashboard">Admin</a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-gold btn-sm px-3">
                                    <i class="fas fa-sign-out-alt me-1"></i>Deconnexion
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-gold btn-sm px-3" href="/register">
                                <i class="fas fa-user-plus me-1"></i>S'inscrire
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5">
        @if(session('success'))
            <div class="container">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer>
        <p class="mb-0">2026 LuxHotel - Tous droits reserves</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // Validation Email
        const emailInputs = document.querySelectorAll('input[type="email"]');
        emailInputs.forEach(input => {
            input.addEventListener('input', function () {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!regex.test(this.value)) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });

        // Validation Mot de passe
        const passwordInput = document.querySelector('input[name="password"]');
        const confirmInput  = document.querySelector('input[name="password_confirmation"]');

        if (passwordInput) {
            passwordInput.addEventListener('input', function () {
                if (this.value.length < 8) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        }

        if (confirmInput) {
            confirmInput.addEventListener('input', function () {
                if (this.value !== passwordInput.value) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                    let feedback = this.nextElementSibling;
                    if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        this.parentNode.appendChild(feedback);
                    }
                    feedback.textContent = 'Les mots de passe ne correspondent pas';
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        }

        // Validation champs requis
        const requiredInputs = document.querySelectorAll('input[required], textarea[required]');
        requiredInputs.forEach(input => {
            input.addEventListener('blur', function () {
                if (!this.value.trim()) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });
        });

    });
    </script>

    @yield('scripts')
</body>
</html>