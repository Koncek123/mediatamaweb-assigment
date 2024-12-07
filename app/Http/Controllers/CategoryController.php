<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.dataMaster.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dataMaster.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge(['name' => strtolower($request->name)]);

        $request->validate(
            [
                'name' => 'required|string|max:25|unique:categories,name',
            ],
            [
                'name.required' => 'Name must be filled',
                'name.max' => 'Name must be less than 25 characters',
                'name.unique' => 'Name already exists',
            ],
        );

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return redirect()->to('admin/category')->with('success', 'Author created successfully');
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
        $author = Category::find($id);
        $author->delete();

        if(!$author){
            return redirect()->to('admin/category')->with('error','Category not found');
        }
        return redirect()->to('admin/category')->with('success','Category deleted successfully');
    }
}
