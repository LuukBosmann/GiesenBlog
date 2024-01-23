<?php

use App\Http\Controllers\GebruikerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReactieController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;

Route::inertia("/", 'Home');

//Authentication
Route::get('/login', [LoginController::class, "create"])->name('login');
Route::post("/login", [LoginController::class, "store"]);
Route::post("/logout", [LoginController::class, "destroy"])->middleware('auth');
Route::inertia('/register','Auth/Register');
Route::post('/register', [GebruikerController::class, 'store']);

Route::middleware('auth')->group(function () {
    //Profile
    Route::get("/profile", [GebruikerController::class, 'index']);
    Route::get("/editProfile", [GebruikerController::class, 'edit']);
    Route::get("/editPassword", [GebruikerController::class, 'editPassword']);
    Route::patch("/editProfile", [GebruikerController::class, 'update']);
    Route::patch("/editPassword", [GebruikerController::class, 'updatePassword']);

    //Comments
    Route::post("/comment", [ReactieController::class, 'store']);
    Route::delete("/deleteComment/{id}", [ReactieController::class, 'destroy']);
    Route::get("/editComment/{id}", [ReactieController::class, 'edit']);
    Route::patch("/updateComment", [ReactieController::class, 'update']);
    Route::get("/myComments", [ReactieController::class, 'myComments']);

    //Blogs
    Route::get('/blogs/{blog}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
    Route::post('/blogs/{blog}/edit', [BlogsController::class, 'update'])->name('blogs.update');
    Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogsController::class, 'store'])->name('blogs.store');
    Route::delete('/blogs/{id}', [BlogsController::class, 'destroy'])->name('blogs.destroy');
    Route::get('/myBlogs', [BlogsController::class, 'myBlogs'])->name('blogs.myBlogs');
});

//Blogs unauthenticated
Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}', [BlogsController::class, 'show'])->name('blogs.show');
