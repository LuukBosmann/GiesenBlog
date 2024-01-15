<?php

use App\Http\Controllers\GebruikerController;
use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BlogsController;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/login', [LoginController::class, "create"])->name('login');
Route::post("/login", [LoginController::class, "authenticate"]);
Route::post("/logout", [LoginController::class, "destroy"])->middleware('auth');

Route::get('/registreer', function () {
    return Inertia::render('Auth/Register');
});

Route::post('/registreer', [GebruikerController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get("/profiel", [GebruikerController::class, 'index']);
    Route::get("/profielwijzigen", [GebruikerController::class, 'edit']);
    Route::get("/wachtwoordwijzigen", [GebruikerController::class, 'editPassword']);
    Route::patch("/profielwijzigen", [GebruikerController::class, "update"]);
    Route::patch("/wachtwoordwijzigen", [GebruikerController::class, "updatePassword"]);
});

Route::get('/blogs', function () {
    return Inertia::render('Blogs/Index');
});

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');

Route::post('/blogs/{blog}/edit', [BlogsController::class, 'update'])->name('blogs.update');


