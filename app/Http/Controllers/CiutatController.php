<?php

namespace App\Http\Controllers;

use App\Models\Ciutat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\In;



class CiutatController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ciutat::all();
    }

    /**
     * Display a listing of the administrated resources (by an admin user).
     */
    public function indexAdministrades()
    {
        $ciutatsAdmin = auth()->user()->ciutatsAdministrades->pluck('ciutat')->toArray();
        Log::channel('dev')->info("Log a CiutatController - ciutats ", $ciutatsAdmin);
        return Ciutat::whereIn('id', $ciutatsAdmin)->get();
    }

    /**
     * Display a listing of the ciutat's administrators
     */
    public function indexAdmins(string $id)
    {
        $ciutat = Ciutat::find($id);
        $adminsCiutat = $ciutat->administradores->pluck('usuaria')->toArray();
        return User::whereIn('id', $adminsCiutat)->get();
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
        return Ciutat::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Ciutat::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ciutat = Ciutat::find($id);
        $ciutat->update($request->all());
        return $ciutat;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Ciutat::destroy($id);
    }
}
