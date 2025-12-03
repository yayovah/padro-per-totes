<?php

namespace App\Http\Controllers;

use App\Models\Imatge;
use Illuminate\Http\Request;

class ImatgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Imatge::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'path' => 'required',
        ]);
        return Imatge::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Imatge::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $imatge = Imatge::find($id);
        $imatge->update($imatge->all());
        return $imatge;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Imatge::destroy($id);
    }
}
