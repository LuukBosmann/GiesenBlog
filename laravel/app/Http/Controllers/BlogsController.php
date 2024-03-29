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
        return Inertia::render('Blogs/Create', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'titel' => 'required',
            'inhoud' => 'required',
            'gebruikersId' => 'required',
        ]);

        // Create a new Blogs entry using the form data
        Blogs::create([
            'titel' => $request->titel,
            'inhoud' => $request->inhoud,
            'gebruikersId' => $request->gebruikersId,
        ]);

        // Render the view with the updated list of blogs
        return Inertia::location('/blogs');
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
            'comments' => Reacties::where('blogs_id', $blog->id)->get(),
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
    public function destroy($id)
    {
        $blogs = Blogs::findOrFail($id);

        // Delete the associated comments first (due to onDelete cascade)
        $blogs->comments()->delete();

        // Then delete the blog
        $blogs->delete();

        return Inertia::location("/blogs");
    }

    public function getUser($gebruikersId)
    {
        return User::find($gebruikersId);
    }

    public function myBlogs()
    {
        return Inertia::render("Profile/MyBlogs", [
            'blogs' => Blogs::where('gebruikersId', Auth::user() ? Auth::user()->id : null)->get(),
            'user' => Auth::user() ? Auth::user() : null
        ]);
    }
}
