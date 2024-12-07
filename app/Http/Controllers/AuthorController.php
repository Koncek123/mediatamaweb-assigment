<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();

        return view('backend.dataMaster.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dataMaster.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:35',
            'email'=>'required|email|unique:authors,email'
        ],
        [
            'name.required'=>'Name must be filled',
            'name.max'=>'Name must be less than 35 characters',
            'email.required'=>'Email must be filled',
            'email.email'=>'Email must be in email format',
            'email.unique'=>'Email must be unique'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->email = $request->email;
        $author->save();

        return redirect()->to('admin/author')->with('success','Author created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);
        $author->delete();

        if(!$author){
            return redirect()->to('admin/author')->with('error','Author not found');
        }
        return redirect()->to('admin/author')->with('success','Author deleted successfully');
    }
}
