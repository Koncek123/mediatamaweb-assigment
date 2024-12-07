@extends('backend.layouts.main')
@section('title', 'Article')
@section('article', 'active')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Article List</h1>
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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <a href="{{ url('admin/article/create') }}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add Article</span>
                    </a>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Tags</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($articles->count() > 0)
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->author->name ?? 'Unknown' }}</td>
                                        <td>
                                            @foreach ($article->categories as $category)
                                                <span class="badge badge-primary">{{ $category->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($article->tags as $tag)
                                                <span class="badge badge-primary">{{ $tag->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $article->created_at->format('d M Y') }}</td>
                                        <td>
                                            <div style="display: flex; gap: 5px;">
                                                <a href="{{ url('admin/article/'.$article->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ url('admin/article/'.$article->id) }}" class="btn btn-sm btn-info">Detail</a>
                                                <form action="{{ url('admin/article/'.$article->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete the article?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No data available</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
