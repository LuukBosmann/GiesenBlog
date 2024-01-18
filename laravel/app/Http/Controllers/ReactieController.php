<?php

namespace App\Http\Controllers;

use App\Models\Reacties;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReactieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'inhoud' => 'required|string',
            'blogId' => 'required|integer',
            'gebruikersId' => 'required|integer',
        ]);

        Reacties::create([
            'inhoud' => $request->inhoud,
            'blogId' => $request->blogId,
            'gebruikersId' => $request->gebruikersId,
        ]);

        return Inertia::location("/blogs/$request->blogId");
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Inertia::render('Blogs/Comments/EditComment', [
            'comment' => Reacties::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'inhoud' => 'required|string',
        ]);

        $reactie = Reacties::find($request->id);
        $reactie->inhoud = $request->inhoud;
        $reactie->save();

        return Inertia::location("/blogs/$reactie->blogId");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Reacties::destroy($id);
    }
}
