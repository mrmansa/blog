@extends('layouts.app')

@section('content')
  <div class="row">
    @foreach($blogs as $blog)
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          @if($blog->image)
            <img src="{{ asset($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $blog->title }}</h5>
            <p class="card-text">{!! Str::limit(strip_tags($blog->content), 120) !!}</p>
            <a href="{{ route('blog.show', $blog) }}" class="btn btn-primary">Read more</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="d-flex justify-content-center">
    {{ $blogs->links() }}
  </div>
@endsection
