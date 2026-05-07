// ============================================
// LUXHOTEL — MAIN JS
// ============================================

document.addEventListener('DOMContentLoaded', function () {

    // ── NAVBAR HAMBURGER ──
    const hamburger = document.querySelector('.hamburger');
    const navLinks  = document.querySelector('.nav-links');

    if (hamburger) {
        hamburger.addEventListener('click', function () {
            navLinks.classList.toggle('open');
        });
    }

    // ── NAVBAR SCROLL EFFECT ──
    window.addEventListener('scroll', function () {
        const navbar = document.querySelector('.navbar');
        if (navbar) {
            if (window.scrollY > 50) {
                navbar.style.padding = '0.5rem 0';
            } else {
                navbar.style.padding = '1rem 0';
            }
        }
    });

    // ── VALIDATION EMAIL ──
    document.querySelectorAll('input[type="email"]').forEach(input => {
        const feedback = input.nextElementSibling;
        input.addEventListener('input', function () {
            const valid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.value);
            this.classList.toggle('valid', valid);
            this.classList.toggle('invalid', !valid);
            if (feedback && feedback.classList.contains('form-feedback')) {
                feedback.textContent = valid ? '' : 'Email invalide';
                feedback.className = `form-feedback ${valid ? '' : 'error'}`;
            }
        });
    });

    // ── VALIDATION MOT DE PASSE ──
    const pwd  = document.querySelector('input[name="password"]');
    const pwd2 = document.querySelector('input[name="password_confirmation"]');

    if (pwd) {
        const feedback = pwd.nextElementSibling;
        pwd.addEventListener('input', function () {
            const valid = this.value.length >= 8;
            this.classList.toggle('valid', valid);
            this.classList.toggle('invalid', !valid);
            if (feedback && feedback.classList.contains('form-feedback')) {
                feedback.textContent = valid ? '✓ Mot de passe valide' : 'Minimum 8 caracteres';
                feedback.className = `form-feedback ${valid ? 'success' : 'error'}`;
            }
        });
    }

    if (pwd2) {
        const feedback = pwd2.nextElementSibling;
        pwd2.addEventListener('input', function () {
            const valid = this.value === pwd.value && this.value.length > 0;
            this.classList.toggle('valid', valid);
            this.classList.toggle('invalid', !valid);
            if (feedback && feedback.classList.contains('form-feedback')) {
                feedback.textContent = valid ? '✓ Mots de passe identiques' : 'Les mots de passe ne correspondent pas';
                feedback.className = `form-feedback ${valid ? 'success' : 'error'}`;
            }
        });
    }

    // ── VALIDATION CHAMPS REQUIS ──
    document.querySelectorAll('input[required], textarea[required]').forEach(input => {
        input.addEventListener('blur', function () {
            const valid = this.value.trim().length > 0;
            this.classList.toggle('valid', valid);
            this.classList.toggle('invalid', !valid);
        });
    });

    // ── CALCUL PRIX RESERVATION ──
    const dateArrivee  = document.getElementById('date_arrivee');
    const dateDepart   = document.getElementById('date_depart');
    const prixParNuit  = document.getElementById('prix_par_nuit');
    const prixBox      = document.getElementById('prix_box');
    const nbNuits      = document.getElementById('nb_nuits');
    const prixTotal    = document.getElementById('prix_total');

    function calculerPrix() {
        if (!dateArrivee || !dateDepart || !prixParNuit) return;

        const arrivee = new Date(dateArrivee.value);
        const depart  = new Date(dateDepart.value);
        const prix    = parseFloat(prixParNuit.value);

        if (dateArrivee.value && dateDepart.value && depart > arrivee) {
            const nuits = Math.round((depart - arrivee) / (1000 * 60 * 60 * 24));
            const total = nuits * prix;

            nbNuits.textContent   = nuits + ' nuit(s)';
            prixTotal.textContent = total.toLocaleString('fr-FR') + ' FCFA';
            prixBox.style.display = 'block';

            // Mettre la date min du depart
            dateDepart.min = dateArrivee.value;
        } else {
            if (prixBox) prixBox.style.display = 'none';
        }
    }

    if (dateArrivee) dateArrivee.addEventListener('change', calculerPrix);
    if (dateDepart)  dateDepart.addEventListener('change', calculerPrix);

    // ── ANIMATIONS AU SCROLL ──
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.card, .service-card').forEach(el => {
        el.style.opacity = '0';
        observer.observe(el);
    });

});