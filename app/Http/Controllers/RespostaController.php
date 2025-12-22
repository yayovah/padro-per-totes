<?php

namespace App\Http\Controllers;

use App\Models\Resposta;
use App\Models\Situacio;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Array_;

class RespostaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Resposta::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required',
        ]);
        return Resposta::create($request->all());
    }

    public function storeByPregunta(Request $request, $preguntaId)
    {
        //Crear la resposta
        $resposta = Resposta::create($request->all());

        $situacio = Situacio::where('pregunta', $preguntaId)->first;
        $ciutatId = $situacio->ciutat;
        if ($situacio->pregunta == null) {
            $situacio->update([
                'resposta' => $resposta->id
            ]);
        } else {
            //Crea una situació si no exitia la parella pregunta/resposta
            Situacio::firstOrCreate([
                'resposta' => $resposta->id,
                'pregunta' => $preguntaId,
                'ciutat' => $ciutatId
            ]);
        }

        return response()->json($resposta);
    }

    public function indexByPregunta($preguntaId)
    {
        $respostes = Situacio::where('pregunta', $preguntaId)->with('resposta')->get()->pluck('resposta');
        return Resposta::whereIn('id', $respostes);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Resposta::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $resposta = Resposta::find($id);
        $resposta->update($resposta->all());
        return $resposta;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Resposta::destroy($id);
    }
}
