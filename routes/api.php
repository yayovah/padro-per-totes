<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CiutatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* ---------------------------------------------------------------------
PUBLIC ROUTES
Rutes públiques, a les que es pot accedir sense requisits prèvis
*/

//Ciutats
Route::get('/ciutats', [CiutatController::class, 'index']);
Route::get('/ciutats/{id}', [CiutatController::class, 'show']);

/* ---------------------------------------------------------------------
PROTECTED ROUTES
Rutes amb accés reservat a usuaries autenticades
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    //Ciutats
    Route::post('/ciutats', [CiutatController::class, 'store']);
    Route::put('/ciutats/{id}', [CiutatController::class, 'update']);
    Route::delete('/ciutats/{id}', [CiutatController::class, 'destroy']);
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
