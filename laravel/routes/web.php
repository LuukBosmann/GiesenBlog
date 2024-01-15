<?php
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

Route::get('/settings', function () {
    return Inertia::render('Settings');
});

Route::get('/blogs', function () {
    return Inertia::render('Blogs/Index');
});

Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{blog}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');

Route::post('/blogs/{blog}/edit', [BlogsController::class, 'update'])->name('blogs.update');


