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

    //Funció per crear una resposta i associar-la a una pregunta mitjançant la situació
    public function storeByPregunta(Request $request, $preguntaId)
    {
        //Crear la resposta
        $resposta = Resposta::create($request->input('resposta'));

        //Crea la situació associant la resposta a la pregunta
        $request->situacio['resposta']= $resposta->id;
        $situacio = Situacio::firstOrCreate($request->input('situacio'));

        //Retornem la resposta i la situació associada
        return response()->json(['resposta' => $resposta, 'situacio' => $situacio]);
    }

    //Funció per obtenir totes les respostes associades a una pregunta
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
        $resposta = Resposta::findOrFail($id);
        $resposta->update($request->all());
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
