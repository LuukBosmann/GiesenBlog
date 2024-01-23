<?php

use App\Http\Controllers\GebruikerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReactieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;

Route::inertia("/", 'Home');

Route::get('/login', [LoginController::class, "create"])->name('login');
Route::post("/login", [LoginController::class, "authenticate"]);
Route::post("/logout", [LoginController::class, "destroy"])->middleware('auth');

Route::inertia('/registreer','Auth/Register');
Route::post('/registreer', [GebruikerController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get("/profiel", [GebruikerController::class, 'index']);
    Route::get("/profielwijzigen", [GebruikerController::class, 'edit']);
    Route::get("/wachtwoordwijzigen", [GebruikerController::class, 'editPassword']);

    Route::patch("/profielwijzigen", [GebruikerController::class, 'update']);
    Route::patch("/wachtwoordwijzigen", [GebruikerController::class, 'updatePassword']);

    Route::post("/comment", [ReactieController::class, 'store']);
    Route::delete("/deleteComment/{id}", [ReactieController::class, 'destroy']);
    Route::get("/reactieBewerken/{id}", [ReactieController::class, 'edit']);
    Route::patch("/updateComment", [ReactieController::class, 'update']);

    Route::get("/mijnReacties", [ReactieController::class, 'myComments']);
});

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
Route::post('/blogs/{blog}/edit', [BlogsController::class, 'update'])->name('blogs.update');
Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
Route::get('/blogs/{blog}', [BlogsController::class, 'show'])->name('blogs.show');
Route::post('/blogs', [BlogsController::class, 'store'])->name('blogs.store');
Route::delete('/blogs/{id}', [BlogsController::class, 'destroy'])->name('blogs.destroy');
Route::get('/mijnBlogs', [BlogsController::class, 'myBlogs'])->name('blogs.myBlogs');

