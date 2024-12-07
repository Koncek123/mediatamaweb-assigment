<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch articles with related data
        $articles = Article::with(['tags', 'categories', 'author'])->latest()->take(6)->get();

        return view('frontend.index', compact('articles'));
    }
}
