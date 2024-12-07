@extends('backend.layouts.main')
@section('title', 'Edit Article')
@section('article', 'active')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Article</h1>
    </div>

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{url('admin/article/'.$article->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title', $article->title) }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select name="category_id" 
                                    class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" 
                                            {{ old('category_id', $article->categories->first()->id ?? null) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div class="form-group mb-3">
                            <label for="author_id">Author</label>
                            <select name="author_id" 
                                    class="form-control @error('author_id') is-invalid @enderror" required>
                                <option value="">Select an Author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" 
                                            {{ old('author_id', $article->author->id ?? null) == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Tags (Checkboxes) -->
                        <div class="form-group mb-3">
                            <label for="tags">Tags</label>
                            <div>
                                @foreach ($tags as $tag)
                                    <div class="form-check">
                                        <input type="checkbox" name="tags[]" 
                                               id="tag_{{ $tag->id }}" 
                                               class="form-check-input @error('tags') is-invalid @enderror" 
                                               value="{{ $tag->id }}"
                                               {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label for="tag_{{ $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                                    </div>
                                @endforeach
                                @error('tags')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="form-group mb-3">
                            <label for="content">Content</label>
                            <textarea name="content" 
                                      class="form-control @error('content') is-invalid @enderror" 
                                      rows="8" required>{{ old('content', $article->content) }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Update Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
