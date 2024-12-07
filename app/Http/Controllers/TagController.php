<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('backend.dataMaster.tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dataMaster.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['name' => strtolower($request->name)]);

        $request->validate(
            [
                'name' => 'required|string|max:25|unique:tags,name',
            ],
            [
                'name.required' => 'Name must be filled',
                'name.max' => 'Name must be less than 25 characters',
                'name.unique' => 'Name already exists',
            ],
        );

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();

        return redirect()->to('admin/tag')->with('success', 'Tag created successfully');
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
        $Tag = Tag::find($id);
        $Tag->delete();

        if(!$Tag){
            return redirect()->to('admin/tag')->with('error','Tag not found');
        }
        return redirect()->to('admin/tag')->with('success','Tag deleted successfully');
    }
}
