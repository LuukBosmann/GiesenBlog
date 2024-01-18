<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Reacties;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Blogs/Index', [
            'blogs' => Blogs::all(),
            'users' => User::whereIn('id', Blogs::pluck('gebruikersId'))->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Blogs/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blogs::findorFail($id);

        return Inertia::render('Blogs/Show', [
            'blog' => $blog,
            'user' => User::find($blog->gebruikersId),
            'users' => User::all(),
            'comments' => Reacties::where('blogId', $blog->id)->get(),
            'loggedInUserId' => Auth::user() ? Auth::user()->id : null
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return Inertia::render('Blogs/Edit', [
            'blog' => Blogs::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blogs $blog)
    {
        $request->validate([
            'titel' => 'required|string|max:255',
            'inhoud' => 'required|string',
        ]);

        $blog->update([
            'titel' => $request->input('titel'),
            'inhoud' => $request->input('inhoud'),
        ]);

        return Inertia::location("/blogs");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blogs $blogs)
    {
        //
    }

    public function getUser($gebruikersId)
    {
        return User::find($gebruikersId);
    }
}
