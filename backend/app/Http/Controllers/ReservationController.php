<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    // Liste des réservations du client
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())
                        ->with('chambre')
                        ->latest()
                        ->get();

        return view('reservations.index', compact('reservations'));
    }

    // Formulaire de réservation
    public function create(Chambre $chambre)
    {
        return view('reservations.create', compact('chambre'));
    }

    // Enregistrer la réservation
    public function store(Request $request)
    {
        $request->validate([
            'chambre_id'       => 'required|exists:chambres,id',
            'date_arrivee'     => 'required|date|after:today',
            'date_depart'      => 'required|date|after:date_arrivee',
            'nombre_personnes' => 'required|integer|min:1',
        ]);

        $chambre = Chambre::findOrFail($request->chambre_id);

        // Calculer le prix total
        $dateArrivee = \Carbon\Carbon::parse($request->date_arrivee);
        $dateDepart  = \Carbon\Carbon::parse($request->date_depart);
        $nuits       = $dateArrivee->diffInDays($dateDepart);
        $prixTotal   = $nuits * $chambre->prix_par_nuit;

        Reservation::create([
            'user_id'           => Auth::id(),
            'chambre_id'        => $request->chambre_id,
            'date_arrivee'      => $request->date_arrivee,
            'date_depart'       => $request->date_depart,
            'nombre_personnes'  => $request->nombre_personnes,
            'prix_total'        => $prixTotal,
            'demandes_speciales'=> $request->demandes_speciales,
            'statut'            => 'en_attente',
        ]);

        // Mettre la chambre en occupée
        $chambre->update(['statut' => 'occupee']);

        return redirect('/reservations')->with('success', 'Réservation effectuée avec succès !');
    }

    // Annuler une réservation
    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            abort(403);
        }

        $reservation->update(['statut' => 'annulee']);
        $reservation->chambre->update(['statut' => 'disponible']);

        return redirect('/reservations')->with('success', 'Réservation annulée !');
    }
}