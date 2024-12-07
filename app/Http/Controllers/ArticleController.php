<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with(['categories', 'tags', 'author'])->get();

        return view('backend.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $authors = Author::all();

        return view('backend.article.create', compact('categories', 'tags', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        $article = Article::create([
            'title' => $validated['title'],
            'author_id' => $validated['author_id'],
            'content' => $validated['content'],
        ]);

        $article->categories()->attach($validated['category_id']);
        $article->tags()->sync($validated['tags']);

        return redirect()->to('admin/article')->with('success', 'Article successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::with(['categories', 'tags', 'author'])->find($id);
        if (!$article) {
            return redirect()->to('admin/article')->with('error', 'Article not found!');
        }
        return view('backend.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::with(['categories', 'tags', 'author'])->find($id);
        if (!$article) {
            return redirect()->to('admin/article')->with('error', 'Article not found!');
        }

        $categories = Category::all();
        $authors = Author::all();
        $tags = Tag::all();

        return view('backend.article.edit', compact('article', 'categories', 'authors', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return redirect()->to('admin/article')->with('error', 'Article not found!');
        }
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
            'content' => 'required|string',
        ]);
        $article->update([
            'title' => $validated['title'],
            'author_id' => $validated['author_id'],
            'content' => $validated['content'],
        ]);
        $article->categories()->sync([$validated['category_id']]);
        $article->tags()->sync($validated['tags']);
        return redirect()->to('admin/article')->with('success', 'Article successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Mencari artikel berdasarkan ID
        $article = Article::find($id);

        if (!$article) {
            return redirect()->to('admin/article')->with('error', 'Article not found');
        }

        // Hapus relasi dengan kategori dan tag
        $article->categories()->detach();
        $article->tags()->detach();

        // Hapus artikel
        $article->delete();
        // Redirect dengan pesan sukses
        return redirect()->to('admin/article')->with('success', 'Article successfully deleted!');
    }
}
