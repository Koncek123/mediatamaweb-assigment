@extends('backend.layouts.main')
@section('title', 'Add Tag')
@section('tag', 'active')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add tag</h1>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Body -->
                <div class="card-body">
                    <!-- Form -->
                    <form action="{{ url('admin/tag') }}" method="POST">
                        @csrf
                        <!-- Nama Lengkap -->
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>
                            @error('name')
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


