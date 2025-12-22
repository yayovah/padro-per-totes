<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use App\Models\Situacio;
use Illuminate\Http\Request;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pregunta::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titol' => 'required',
            'text' => 'required',
        ]);
        return Pregunta::create($request->all());
    }

    public function storeByCiutat(Request $request, $ciutatId)
    {
        //Crear la pregunta
        $pregunta = Pregunta::create($request->all());
        //Crea la situació
        $situacio = Situacio::create([
            'ciutat' => $ciutatId,
            'pregunta' => $pregunta->id
        ]);

        return response()->json($pregunta);
    }

    public function indexByCiutat($ciutatId)
    {
        return Pregunta::where('ciutat', $ciutatId);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Pregunta::find($id);
    }
    /**
     * Display the first resource with a determinated city ID
     */
    public function showDeCiutat(string $ciutat_id)
    {
        //Seleccionem totes les sitaucions referents a la ciutat
        $situacions = Situacio::where('ciutat', $ciutat_id)->orderBy('created_at', 'asc')->get();
        //Es genera un array amb les preguntes de la ciutat, només un cop cada pregunta
        $preguntes = [];
        foreach ($situacions as $situacio) {
            $pregunta = Pregunta::find($situacio['pregunta']);
            if (!in_array($pregunta, $preguntes)) {
                $preguntes[] = $pregunta;
            }
        }
        return $preguntes;
    }
    /**
     * Display the first resource with a determinated city ID
     */

    public function showPrimeraDeCiutat(string $ciutat_id)
    {
        $primeraSituacio = Situacio::where('ciutat', $ciutat_id)->orderBy('created_at', 'asc')->first();
        return Pregunta::find($primeraSituacio['pregunta']);
        //return $primeraSituacio;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pregunta = Pregunta::find($id);
        $pregunta->update($pregunta->all());
        return $pregunta;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Pregunta::destroy($id);
    }
}
