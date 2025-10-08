@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between mb-3">
    <h3>All Blogs</h3>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">New Blog</a>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr><th>Title</th><th>Author</th><th>Status</th><th>Actions</th></tr>
    </thead>
    <tbody>
      @foreach($blogs as $blog)
        <tr id="blog-{{ $blog->id }}">
          <td>{{ $blog->title }}</td>
          <td>{{ $blog->user->name }}</td>
          <td class="status">{{ $blog->status }}</td>
          <td>
            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-primary">Edit</a>
            <button class="btn btn-sm btn-secondary btn-change-status" data-id="{{ $blog->id }}" data-status="published">Publish</button>
            <button class="btn btn-sm btn-warning btn-change-status" data-id="{{ $blog->id }}" data-status="pending">Pending</button>
            <button class="btn btn-sm btn-danger btn-change-status" data-id="{{ $blog->id }}" data-status="rejected">Reject</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {{ $blogs->links() }}
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const buttons = document.querySelectorAll('.btn-change-status');
  buttons.forEach(btn => {
    btn.addEventListener('click', function() {
      const id = this.dataset.id;
      const status = this.dataset.status;

      fetch("{{ url('admin/blogs') }}/" + id + "/status", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ status })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          const row = document.querySelector('#blog-' + id);
          row.querySelector('.status').innerText = data.status;
        } else {
          alert('Status update failed.');
        }
      })
      .catch(err => {
        console.error(err);
        alert('Error');
      });
    });
  });
});
</script>
@endpush
