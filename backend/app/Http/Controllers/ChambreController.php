<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    // Liste des chambres
    public function index(Request $request)
    {
        $query = Chambre::where('statut', 'disponible');

        if ($request->type) {
            $query->where('type', $request->type);
        }

        $chambres = $query->get();

        return view('chambres.index', compact('chambres'));
    }

    // Détail d'une chambre
    public function show(Chambre $chambre)
    {
        return view('chambres.show', compact('chambre'));
    }

    // Admin — Ajouter une chambre
    public function store(Request $request)
    {
        $request->validate([
            'numero'        => 'required|unique:chambres',
            'type'          => 'required|in:simple,double,suite,familiale',
            'prix_par_nuit' => 'required|numeric',
            'capacite'      => 'required|integer',
            'description'   => 'nullable|string',
        ]);

        Chambre::create($request->all());

        return redirect('/admin/chambres')->with('success', 'Chambre ajoutée avec succès !');
    }

    // Admin — Modifier une chambre
    public function update(Request $request, Chambre $chambre)
    {
        $request->validate([
            'prix_par_nuit' => 'required|numeric',
            'statut'        => 'required|in:disponible,occupee,maintenance',
        ]);

        $chambre->update($request->all());

        return redirect('/admin/chambres')->with('success', 'Chambre modifiée avec succès !');
    }

    // Admin — Supprimer une chambre
    public function destroy(Chambre $chambre)
    {
        $chambre->delete();
        return redirect('/admin/chambres')->with('success', 'Chambre supprimée !');
    }
}