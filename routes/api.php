<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/* ---------------------------------------------------------------------
PUBLIC ROUTES
Rutes públiques, a les que es pot accedir sense requisits prèvis
*/



/* ---------------------------------------------------------------------
PROTECTED ROUTES
Rutes amb accés reservat a usuaries autenticades
*/
Route::group(['middleware' => ['auth:sanctum']], function () {

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
