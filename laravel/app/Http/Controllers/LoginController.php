<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create()
    {
        return Inertia::render("Auth/Login");
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended();
    }

    public function destroy()
    {
        Auth::logout();

        return redirect(RouteServiceProvider::HOME);
    }
}
