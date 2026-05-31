<?php

namespace App\Http\Controllers;

use App\Models\Itinerari;
use Illuminate\Http\Request;

class ItinerariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Itinerari::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ciutat' => 'required',
        ]);
        //Es crea un nou itinerari
        return Itinerari::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Itinerari::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $itinerari = Itinerari::find($id);
        $itinerari->update($request->all());
        return $itinerari;
    }

    //Funció per obtenir l'itinerari associat a un usuari, amb les relacions de passos, preguntes, respostes i ciutat
    public function getByUser(string $id)
    {
        $itinerari = Itinerari::where('usuaria', $id)
        //Carreguem les relacions
        ->with(['passos.relPregunta', 'passos.relResposta', 'relCiutat'])
        ->firstOrFail();

        return response()->json($itinerari);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Itinerari::destroy($id);
    }

}
