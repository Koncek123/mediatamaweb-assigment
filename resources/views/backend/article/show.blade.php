@extends('backend.layouts.main')
@section('title', 'Article Detail')
@section('article', 'active')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Article Detail</h1>
            <a href="{{ url('admin/article') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back to List</span>
            </a>
        </div>

        <div class="row">
            <div class="col">
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">
                        <h4 class="card-title">{{ $article->title }}</h4>
                        <p class="text-muted">
                            <strong>Author:</strong> {{ $article->author->name ?? 'Unknown' }} |
                        <p><strong>Categories:</strong></p>
                        <ul>
                            @forelse ($article->categories as $category)
                                <li>{{ $category->name }}</li>
                            @empty
                                <li>No Categories</li>
                            @endforelse
                        </ul>
                        </p>
                        <hr>
                        <p>{!! nl2br(e($article->content)) !!}</p>
                        <hr>
                        <h5>Tags:</h5>
                        <div>
                            @forelse ($article->tags as $tag)
                                <span class="badge badge-primary">{{ $tag->name }}</span>
                            @empty
                                <p>No Tags Available</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
