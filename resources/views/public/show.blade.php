@extends('layouts.app')

@section('content')
  <div class="card">
    @if($blog->image)
      <img src="{{ asset($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
    @endif
    <div class="card-body">
      <h2>{{ $blog->title }}</h2>
      <p class="text-muted">By {{ $blog->user->name }} | {{ $blog->created_at->format('M d, Y') }}</p>
      <div>{!! $blog->content !!}</div>
    </div>
  </div>
@endsection
