<?php

namespace App\Http\Controllers;

use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class GebruikerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'voornaam' => 'required',
            'achternaam' => 'required',
            'email' => 'required|email',
            'wachtwoord' => 'required',
            'profielFotoUrl' => 'nullable',
        ]);

        $gebruiker = new Gebruiker();
        $gebruiker->voornaam = $request->voornaam;
        $gebruiker->achternaam = $request->achternaam;
        $gebruiker->email = $request->email;
        $gebruiker->wachtwoord = Hash::make($request->wachtwoord);
        $gebruiker->profielFotoUrl = $request->profielFotoUrl;

        $gebruiker->save();

        return Inertia::location("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(Gebruiker $gebruiker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gebruiker $gebruiker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gebruiker $gebruiker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gebruiker $gebruiker)
    {
        //
    }
}
