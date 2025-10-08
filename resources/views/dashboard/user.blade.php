@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ $user->name }}</h2>
    <p>Your blogs:</p>

    @if($blogs->count())
        <div class="list-group">
            @foreach($blogs as $blog)
                <a href="{{ route('blog.show', $blog) }}" class="list-group-item list-group-item-action">
                    {{ $blog->title }} - <span class="text-muted">{{ ucfirst($blog->status) }}</span>
                </a>
            @endforeach
        </div>
    @else
        <p>You haven't created any blogs yet.</p>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">Create Blog</a>
    @endif
</div>
@endsection
