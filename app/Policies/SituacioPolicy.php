<?php

namespace App\Policies;

use App\Models\User;
use App\Models\situacio;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class SituacioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, situacio $situacio): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, situacio $situacio): bool
    {
        $ciutat=$situacio['ciutat'];
        Log::channel('dev')->info("Log a la policy - ciutat {$ciutat} - user {$user->id}");
        //L'admin només podrà crear situacions per ciutats on tingui permís
        $ciutatsAdmin = auth()->user()->ciutatsAdministrades->pluck('ciutat')->toArray(); //Agafem la columna de ciutats en que té permis l'usuari
        return in_array($ciutat,$ciutatsAdmin);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, situacio $situacio): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, situacio $situacio): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, situacio $situacio): bool
    {
        return false;
    }

    public function crearSegonsCiutat(User $user, $ciutat): bool
    {
        Log::channel('dev')->info("ciutat: {$ciutat}");
        //L'admin només podrà crear situacions per ciutats on tingui permís
        if($ciutat){ return true; }
        $ciutatsAdmin = auth()->user()->ciutatsAdministrades->pluck('ciutat')->toArray(); //Agafem la columna de ciutats en que té permis l'usuari
        return in_array($ciutat,$ciutatsAdmin);
    }

}
