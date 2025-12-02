<?php

namespace App\Http\Controllers;

use App\Models\Permis;
use Illuminate\Http\Request;

class PermisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Permis::all();
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
        return Permis::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Permis::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permis = Permis::find($id);
        $permis->update($permis->all());
        return $permis;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Permis::destroy($id);
    }
}
