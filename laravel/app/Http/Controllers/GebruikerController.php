<?php

namespace App\Http\Controllers;

use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class GebruikerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // TODO: dynamisch maken
        $user = Gebruiker::find(2);

        return Inertia::render('Profile/Index', [
            'user' => $user,
            'profielFoto' => asset("storage/uploads/$user->profielFoto")
        ]);
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
        $request->validate([
            'voornaam' => 'required',
            'achternaam' => 'required',
            'email' => 'required',
            'wachtwoord' => 'required',
            'profielFoto' => 'required',
        ]);

        $file = $request->file('profielFoto');

        $filename = uniqid() . '_' . $file->getClientOriginalName();

        $file->storeAs('uploads', $filename, 'public');

        Gebruiker::create([
            'voornaam' => $request->voornaam,
            'achternaam' => $request->achternaam,
            'email' => $request->email,
            'wachtwoord' => Hash::make($request->wachtwoord),
            'profielFoto' => $filename
        ]);

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
    public function edit($gebruikersId): Response
    {
        return Inertia::render('Profile/Edit/EditProfile', [
            'user' => Gebruiker::find($gebruikersId),
        ]);
    }

    public function editPassword($gebruikersId): Response
    {
        return Inertia::render('Profile/Edit/EditPassword', [
            'user' => Gebruiker::find($gebruikersId),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'voornaam' => 'required',
            'achternaam' => 'required',
            'email' => 'required',
        ]);

        $gebruiker = Gebruiker::find($id);

        $gebruiker->voornaam = $request->voornaam;
        $gebruiker->achternaam = $request->achternaam;
        $gebruiker->email = $request->email;
        $gebruiker->wachtwoord = $request->wachtwoord;

        $gebruiker->save();

        return Inertia::location("/profiel");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gebruiker $gebruiker)
    {
        //
    }
}
