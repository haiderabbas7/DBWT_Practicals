<?php

use App\Http\Controllers\BewertungController;
use App\Http\Controllers\WerbeseiteController;
use App\Http\Controllers\AnmeldungController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [WerbeseiteController::class, 'werbeseite']);

Route::get('/anmeldung', [AnmeldungController::class, 'anmeldung']);

Route::match(['get', 'post'],'/anmeldung_verifizieren', [AnmeldungController::class, 'anmeldung_verifizieren']);

Route::get('/abmeldung', [AnmeldungController::class, 'abmeldung']);

Route::get('/profil', [AnmeldungController::class, 'profil']);

Route::get('/bewertung', [BewertungController::class, 'bewertung']);

Route::match(['get', 'post'],'/bewertung_verifizieren', [BewertungController::class, 'bewertung_verifizieren']);

Route::get('/bewertungen', [BewertungController::class, 'bewertungen']);

Route::get('/meinebewertungen', [BewertungController::class, 'meinebewertungen']);

Route::match(['get','post'], '/bewertung_loeschen', [BewertungController::class, 'bewertung_loeschen']);
