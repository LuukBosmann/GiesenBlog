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
        $user = Gebruiker::find(4);
        return Inertia::render('Profile/Index', [
            'user' => $user,
            'profielFoto' => asset("uploads/$user->profielFotoUrl")
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
    public function update(Request $request, Gebruiker $gebruiker)
    {
        $image_path = '';

        if($request->hasFile('image')) {
            $image_path = $request->file('image')->store('image', 'public');
        }

        $data = Gebruiker::create([
            'image' => $image_path,
        ]);

        return Inertia::location("/profile");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gebruiker $gebruiker)
    {
        //
    }
}
