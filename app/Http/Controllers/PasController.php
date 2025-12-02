<?php

namespace App\Http\Controllers;

use App\Models\Pas;
use Illuminate\Http\Request;

class PasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pas::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'activada' => 'required',
        ]);
        return Pas::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Pas::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pas = Pas::find($id);
        $pas->update($pas->all());
        return $pas;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Pas::destroy($id);
    }
}
