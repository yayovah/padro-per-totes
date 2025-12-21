<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CiutatController;
use App\Http\Controllers\ImatgeController;
use App\Http\Controllers\ItinerariController;
use App\Http\Controllers\PasController;
use App\Http\Controllers\PermisController;
use App\Http\Controllers\PreguntaController;
use App\Http\Controllers\RespostaController;
use App\Http\Controllers\SituacioController;
use App\Http\Middleware\RolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* ---------------------------------------------------------------------
PUBLIC ROUTES
Rutes públiques, a les que es pot accedir sense requisits prèvis
*/

//Users
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Ciutats
Route::get('/ciutats', [CiutatController::class, 'index']);
Route::get('/ciutats/{id}', [CiutatController::class, 'show']);


//Preguntes
Route::get('/preguntes/{id}', [PreguntaController::class, 'show']);
Route::get('/preguntes/ciutat/{id}/primera', [PreguntaController::class, 'showPrimeraDeCiutat']);
Route::get('/preguntes/ciutat/{id}', [PreguntaController::class, 'showDeCiutat']);

//Respostes
Route::get('/respostes/{id}', [RespostaController::class, 'show']);

//Itineraris
Route::get('/itineraris/{id}', [ItinerariController::class, 'show']);
Route::post('/itineraris', [ItinerariController::class, 'store']);

//Passos
Route::get('/passos', [PasController::class, 'index']);
Route::post('/passos', [pasController::class, 'store']);
Route::get('/passos/{id}', [PasController::class, 'show']);
//Route::put('/passos/{id}', [pasController::class, 'update']);
Route::delete('/passos/{id}', [pasController::class, 'destroy']);

//Situacions
Route::get('/situacions/{id}', [SituacioController::class, 'show']);
Route::get('/situacions/ciutat/{id}/primera', [SituacioController::class, 'showPrimeraDeCiutat']);

/* ---------------------------------------------------------------------
PROTECTED ROUTES
Rutes amb accés reservat a usuaries autenticades
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Itineraris
    Route::delete('/itineraris/{id}', [ItinerariController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});

/* ---------------------------------------------------------------------
PROTECTED ROUTES BY USER ROL
Rutes amb accés reservat segons el rol
*/

/*          ADMIN           */

Route::middleware(['auth:sanctum', RolRequest::class . ':admin'])->group(function () {
    //Ciutats
    Route::get('/ciutatsAdministrades', [CiutatController::class, 'indexAdministrades']);

    //Preguntes
    Route::post('/preguntes', [PreguntaController::class, 'store']);
    Route::put('/preguntes/{id}', [PreguntaController::class, 'update']);
    Route::delete('/preguntes/{id}', [PreguntaController::class, 'destroy']);

    //Respostes
    Route::post('/respostes', [RespostaController::class, 'store']);
    Route::put('/respostes/{id}', [RespostaController::class, 'update']);
    Route::delete('/respostes/{id}', [RespostaController::class, 'destroy']);

    //Itineraris
    Route::get('/itineraris', [ItinerariController::class, 'index']);

    //Situacions
    Route::get('/situacions', [SituacioController::class, 'index']);
    Route::post('/situacions', [SituacioController::class, 'store']);
    Route::put('/situacions/{id}', [SituacioController::class, 'update']);
    Route::delete('/situacions/{id}', [SituacioController::class, 'destroy']);
    Route::get('/situacions/ciutat/{id}', [SituacioController::class, 'showDeCiutat']);
});

/*          SUPERADMIN           */

Route::middleware(['auth:sanctum', RolRequest::class . ':superadmin'])->group(function () {
    //Usuaries
    Route::get('/users/{rol}', [AuthController::class, 'indexByRol']);


    //Ciutats
    Route::put('/ciutats/{id}', [CiutatController::class, 'update']);
    Route::post('/ciutats', [CiutatController::class, 'store']);
    Route::delete('/ciutats/{id}', [CiutatController::class, 'destroy']);
    Route::get('/ciutats/{id}/admins', [CiutatController::class, 'indexAdmins']);
    Route::delete('ciutats/ciutat/{ciutatId}/admin/{adminId}', [CiutatController::class, 'deleteAdmin']);

    //Canviar Rol
    Route::post('/canviaRol', [AuthController::class, 'userRol']);

    //Administradores (Permisos)
    Route::resource('/permisos', PermisController::class);

    //Preguntes
    Route::get('/preguntes', [PreguntaController::class, 'index']);

    //Respostes
    Route::get('/respostes', [RespostaController::class, 'index']);
});

/* ---------------------------------------------------------------------
GUEST ROUTES
Les rutes que els usuaries autenticades no han de poder executar, com login o registre
*/
Route::group(['middleware' => ['guest']], function () {});

//Sanctum default
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
