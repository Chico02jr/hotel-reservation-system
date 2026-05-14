<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create(Chambre $chambre)
    {
        return view('reservations.create', compact('chambre'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chambre_id'   => 'required|exists:chambres,id',
            'date_arrivee' => 'required|date',
            'date_depart'  => 'required|date',
        ]);

        $chambre = Chambre::findOrFail($request->chambre_id);

        $jours = \Carbon\Carbon::parse($request->date_arrivee)
                    ->diffInDays($request->date_depart);

        Reservation::create([
            'user_id'      => 1,
            'chambre_id'   => $request->chambre_id,
            'date_arrivee' => $request->date_arrivee,
            'date_depart'  => $request->date_depart,
            'statut'       => 'en_attente',
            'montant_total'=> $chambre->prix_par_nuit * $jours,
        ]);

        echo "Réservation effectuée avec succès !";
        exit;
    }

   public function index()
{
    $reservations = Reservation::with('chambre')
                        ->latest()
                        ->get();
    return view('reservations.index', compact('reservations'));
}

    public function cancel(Reservation $reservation)
    {
        $reservation->update(['statut' => 'annulee']);
        $reservation->chambre->update(['statut' => 'disponible']);
        return back()->with('success', 'Réservation annulée !');
    }
}