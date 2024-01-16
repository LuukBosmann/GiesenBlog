<?php

namespace App\Http\Controllers;

use App\Models\blogs;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = blogs::all();

        return Inertia::render('Blogs/Index', [
            'blogs' => blogs::all(),
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
    public function show(blogs $blogs)
    {
        return Inertia::render('Blogs/Show', [
            'blog' => $blogs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $blog = Blogs::findOrFail($id);

    return Inertia::render('Blogs/Edit', [
        'blog' => $blog,
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
    public function destroy(blogs $blogs)
    {
        //
    }
}
