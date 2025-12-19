<?php

namespace App\Http\Controllers;

use App\Models\Situacio;
use App\Models\User;
use App\Models\Ciutat;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class SituacioController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Filtrem les situacions que es poden retornar a un administrador en funció dels seus permisos
        $user = auth()->user(); //Agafem l'usuari que fa la sol·licitud
        $ciutatsAdmin = $user->ciutatsAdministrades->pluck('ciutat')->toArray(); //Agafem la columna de ciutats en que té permis l'usuari
        return Situacio::whereIn('ciutat', $ciutatsAdmin)->get(); //Seleccionem i retornem les situacions on l'usuari té permis
        //return response()->json($situacions); //retornem només les cituacions corresponents a les ciutats amb permís de l'usuari
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pregunta' => 'required',
            'ciutat' => 'required',
        ]);
        return Situacio::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Situacio::find($id);
    }
    /**
    * Display the first resource with a determinated city ID
    */
    public function showDeCiutat(string $ciutat_id){
        $Situacions = Situacio::where('ciutat', $ciutat_id)->orderBy('created_at', 'asc')->get();
        return $Situacions;
    }
    /**
    * Display the first resource with a determinated city ID
    */
    public function showPrimeraDeCiutat(string $ciutat_id){
        $primeraSituacio = Situacio::where('ciutat', $ciutat_id)->orderBy('created_at', 'asc')->first();
        return $primeraSituacio;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $situacio = Situacio::find($id);
        $this->authorize('update', $situacio);
        $situacio->update($request->all());
        return $situacio;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Situacio::destroy($id);
    }
}
