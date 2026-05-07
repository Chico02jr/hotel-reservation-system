<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chambre;
use App\Models\Reservation;
use App\Models\Paiement;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalChambres     = Chambre::count();
        $totalReservations = Reservation::count();
        $totalClients      = User::where('role', 'client')->count();
        $totalRevenus      = Paiement::where('statut', 'paye')->sum('montant');

        $dernieresReservations = Reservation::with(['user', 'chambre'])
                                ->latest()
                                ->take(10)
                                ->get();

        // Reservations par mois
        $reservationsParMois = array_fill(0, 12, 0);
        $data = Reservation::select(
                    DB::raw('MONTH(created_at) as mois'),
                    DB::raw('COUNT(*) as total')
                )
                ->whereYear('created_at', date('Y'))
                ->groupBy('mois')
                ->get();

        foreach ($data as $item) {
            $reservationsParMois[$item->mois - 1] = $item->total;
        }

        // Chambres par type
        $types = ['simple', 'double', 'suite', 'familiale'];
        $chambresParType = [];
        foreach ($types as $type) {
            $chambresParType[] = Chambre::where('type', $type)->count();
        }

        return view('admin.dashboard', compact(
            'totalChambres',
            'totalReservations',
            'totalClients',
            'totalRevenus',
            'dernieresReservations',
            'reservationsParMois',
            'chambresParType'
        ));
    }

    public function chambres()
    {
        $chambres = Chambre::latest()->get();
        return view('admin.chambres', compact('chambres'));
    }

    public function reservations()
    {
        $reservations = Reservation::with(['user', 'chambre'])->latest()->get();
        return view('admin.reservations', compact('reservations'));
    }

    public function confirmerReservation(Reservation $reservation)
    {
        $reservation->update(['statut' => 'confirmee']);
        return back()->with('success', 'Reservation confirmee !');
    }

    public function annulerReservation(Reservation $reservation)
    {
        $reservation->update(['statut' => 'annulee']);
        $reservation->chambre->update(['statut' => 'disponible']);
        return back()->with('success', 'Reservation annulee !');
    }
}