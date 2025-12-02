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
            'nom' => 'required',
            'activada' => 'required',
        ]);
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
        $itinerari->update($itinerari->all());
        return $itinerari;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Itinerari::destroy($id);
    }
}
