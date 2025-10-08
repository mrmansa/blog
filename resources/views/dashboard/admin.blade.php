@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ $user->name }} (Admin)</h2>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Blogs</h5>
                    <p class="card-text">{{ $totalBlogs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pending Blogs</h5>
                    <p class="card-text">{{ $pending }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Published Blogs</h5>
                    <p class="card-text">{{ $published }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Rejected Blogs</h5>
                    <p class="card-text">{{ $rejected }}</p>
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary mt-3">Manage Blogs</a>
</div>
@endsection
