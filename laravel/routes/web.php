<?php

use App\Http\Controllers\GebruikerController;
use App\Models\Gebruiker;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/users', function () {
    return Inertia::render('Users');
});

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
});

//Route::post("/loginUser", function () {
//    $atrributes = Request::validate([
//        'email' => ['required', 'email'],
//        'wachtwoord' => 'required',
//    ]);
//
////    User::create($atrributes);
//
//    return Inertia::location('/');
//});

Route::get('/registreer', function () {
    return Inertia::render('Auth/Register');
});

Route::post('registreer', [GebruikerController::class, 'store'])->name('registreer');
