<?php

namespace App\Http\Controllers;

use App\Models\Situacio;
use Illuminate\Http\Request;

class SituacioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Situacio::all();
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $situacio = Situacio::find($id);
        $situacio->update($situacio->all());
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
