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

/*
    USUARIS
*/
Route::post('register', [AuthController::class, 'register']);

//Ciutats
Route::get('/ciutats', [CiutatController::class, 'index']);
Route::get('/ciutats/{id}', [CiutatController::class, 'show']);

//Preguntes
Route::get('/preguntes', [PreguntaController::class, 'index']);
Route::get('/preguntes/{id}', [PreguntaController::class, 'show']);

//Respostes
Route::get('/respostes', [RespostaController::class, 'index']);
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
Route::get('/situacions', [SituacioController::class, 'index']);
Route::get('/situacions/{id}', [SituacioController::class, 'show']);

/* ---------------------------------------------------------------------
PROTECTED ROUTES
Rutes amb accés reservat a usuaries autenticades
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Itineraris
    Route::delete('/itineraris/{id}', [ItinerariController::class, 'destroy']);
});

/* ---------------------------------------------------------------------
PROTECTED ROUTES BY USER ROL
Rutes amb accés reservat segons el rol
*/
Route::middleware(['auth:sanctum', RolRequest::class.'admin'])->group(function () {
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
    Route::post('/situacions', [SituacioController::class, 'store']);
    Route::put('/situacions/{id}', [SituacioController::class, 'update']);
    Route::delete('/situacions/{id}', [SituacioController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', RolRequest::class.':superadmin'])->group(function () {
    //Ciutats
    Route::post('/ciutats', [CiutatController::class, 'store']);
    Route::put('/ciutats/{id}', [CiutatController::class, 'update']);
    Route::delete('/ciutats/{id}', [CiutatController::class, 'destroy']);

    //Canviar Rol
    Route::post('/canviaRol', [AuthController::class, 'userRol']);
    
    //Administradores (Permisos)
    Route::resource('/permisos', PermisController::class);
});

/* ---------------------------------------------------------------------
GUEST ROUTES
Les rutes que els usuaries autenticades no han de poder executar, com login o registre
*/
Route::group(['middleware' => ['guest']], function(){

});

//Sanctum default
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
