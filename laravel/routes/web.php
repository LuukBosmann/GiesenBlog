<?php

use App\Http\Controllers\GebruikerController;
use App\Models\Gebruiker;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlogsController;

Route::get('/', function () {
    return Inertia::render('Home', [
        'laravel' => Application::VERSION,
        'php' => PHP_VERSION
    ]);
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

Route::get('/blogs', function () {
    return Inertia::render('Blogs/Index');
});

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');

Route::post('/blogs/{blog}/edit', [BlogsController::class, 'update'])->name('blogs.update');


