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

    //Funció per crear una pregunta i associar-la a una ciutat mitjançant la situació
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

    //Funció per obtenir totes les preguntes associades a una ciutat
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

    //Funció per obtenir totes les preguntes associades a una ciutat, ordenades per data de creació
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

    //Funció per obtenir la primera pregunta associada a una ciutat, ordenada per data de creació
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
        $pregunta = Pregunta::findOrFail($id);
        $pregunta->update($request->all());
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
