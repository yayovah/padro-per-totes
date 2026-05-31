<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Itinerari;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Funcions d'autenticació i gestió d'usuaris, com registre, login, logout, canvi de rol i llistat d'usuaris per rol

    //Funció per registrar un nou usuari, amb validació de dades i creació de token d'autenticació
    public function register(Request $request): Response
    {
        //Validació de dades
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'rol' => 'string'
        ]);

        //Assignació de rol, per defecte 'user' si no es proporciona o si el rol proporcionat no és 'admin'
        $rol = ($fields['rol'] !== 'admin' )?  'user' : 'admin';

        //Creació de l'usuari amb les dades validades i el rol assignat
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'rol' => $rol
        ]);

        //Creació d'un token d'autenticació per a l'usuari registrat
        $token = $user->createToken('pptToken')->plainTextToken;

        //Resposta amb les dades de l'usuari i el token d'autenticació
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //Funció per registrar un nou usuari associat a un itinerari, amb validació de dades i creació de token d'autenticació
    public function userRegister(Request $request, string $itinerariId): Response
    {
        //Validació de dades
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'        ]);

        //Assignació de rol 'user' per a aquest tipus de registre
        $rol = 'user';

        //Creació de l'usuari amb les dades validades i el rol 'user'
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'rol' => $rol
        ]);

        //Creació d'un token d'autenticació per a l'usuari registrat
        $token = $user->createToken('pptToken')->plainTextToken;

        //Associació de l'usuari creat amb l'itinerari especificat, actualitzant el camp 'usuaria' de l'itinerari   
        $itinerari = Itinerari::findOrFail($itinerariId);
        $itinerari->usuaria = $user->id;
        $itinerari->save();

        //Resposta amb les dades de l'usuari i el token d'autenticació
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //Funció per autenticar un usuari existent, amb validació de dades i creació de token d'autenticació    
    public function login(Request $request): Response
    {
        //Validació de dades
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        //Recuperació de l'usuari per email i verificació de la contrasenya
        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        //Creació d'un token d'autenticació per a l'usuari autenticat
        $token = $user->createToken('pptToken')->plainTextToken;

        //Resposta amb les dades de l'usuari i el token d'autenticació
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    //Funció per tancar la sessió de l'usuari actual
    public function logout(Request $request)
    {
        //Elimina tots els tokens d'autenticació de l'usuari actual
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    //Funció per comprobar el rol d'un usuari
    public function userRol(Request $request)
    {
        if (in_array($request['rol'], ['user', 'admin', 'superadmin'])) {
            $usuari = User::find($request['id']);
            if ($usuari) {
                $usuari->update($request->all());
                return $usuari;
            } else {
                return ['message' => 'No existeix l\'usuari'];
            }
        } else {
            return ['message' => 'Rol no vàlid'];
        }
    }

    // Funció per obtenir un llistat d'usuaris filtrats per rol
    public function indexByRol(string $rol)
    {
        return User::where('rol', $rol)->get();
    }
}
