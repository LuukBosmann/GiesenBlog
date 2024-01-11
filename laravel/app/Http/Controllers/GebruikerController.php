<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = User::find(Auth::user()->id);

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
            'password' => 'required',
            'profielFoto' => 'required',
        ]);

        $file = $request->file('profielFoto');

        $filename = uniqid() . '_' . $file->getClientOriginalName();

        $file->storeAs('uploads', $filename, 'public');

        User::create([
            'voornaam' => $request->voornaam,
            'achternaam' => $request->achternaam,
            'email' => $request->email,
            'password' => Hash::make($request->password, [
                'rounds' => 12
            ]),
            'profielFoto' => $filename
        ]);

        return Inertia::location("/");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $gebruiker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): Response
    {
        return Inertia::render('Profile/Edit/EditProfile', [
            'user' => User::find(Auth::user()->id),
        ]);
    }

    public function editPassword(): Response
    {
        return Inertia::render('Profile/Edit/EditPassword', [
            'user' => User::find(Auth::user()->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'voornaam' => 'required',
            'achternaam' => 'required',
            'email' => 'required',
        ]);

        $gebruiker = User::find(Auth::user()->id);

        $gebruiker->voornaam = $request->voornaam;
        $gebruiker->achternaam = $request->achternaam;
        $gebruiker->email = $request->email;

        $gebruiker->save();

        return Inertia::location("/profiel");
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'huidigWachtwoord' => 'required',
            'nieuwWachtwoord' => 'required',
        ]);

        $gebruiker = User::find(Auth::user()->id);

        if (!Hash::check($request->huidigWachtwoord, $gebruiker->password, ["rounds" => 12])) {
            return Inertia::location("/");
        }

        $gebruiker->password = Hash::make($request->nieuwWachtwoord);

        $gebruiker->save();

        return Inertia::location("/profiel");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $gebruiker)
    {
        //
    }
}
