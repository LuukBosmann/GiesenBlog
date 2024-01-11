<?php

use App\Http\Controllers\GebruikerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/registreer', function () {
    return Inertia::render('Auth/Register');
});

Route::post('/registreer', [GebruikerController::class, 'store']);

Route::get("/profiel", [GebruikerController::class, 'index']);
Route::get("/profielwijzigen/{gebruikersId}", [GebruikerController::class, 'edit']);
Route::get("/wachtwoordwijzigen/{gebruikersId}", [GebruikerController::class, 'editPassword']);

Route::patch("/wijzigProfiel/{id}", [GebruikerController::class, "update"]);
Route::patch("/wijzigWachtwoord/{id}", [GebruikerController::class, "updatePassword"]);
