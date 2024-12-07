@extends('backend.layouts.main')
@section('title', 'Add Article')
@section('article', 'active')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Article</h1>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{ url('admin/article') }}" method="POST">
                        @csrf
                        <!-- Title -->
                        <div class="form-group mb-3">
                            <label for="title">Title</label>
                            <input type="text" name="title" 
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group mb-3">
                            <label for="category_id">Category</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            <select name="author_id" class="form-control @error('author_id') is-invalid @enderror" required>
                                <option value="">-- Select Author --</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
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

                        <!-- Tags -->
                        <div class="form-group mb-3">
                            <label for="tags">Tags</label>
                            <div>
                                @foreach ($tags as $tag)
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" 
                                            class="form-check-input @error('tags') is-invalid @enderror"
                                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $tag->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            @error('tags')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="form-group mb-3">
                            <label for="content">Content</label>
                            <textarea name="content" rows="5"
                                class="form-control @error('content') is-invalid @enderror"
                                required>{{ old('content') }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
