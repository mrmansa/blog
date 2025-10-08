<?php
namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')->orderBy('created_at','desc')->paginate(6);
        return view('public.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        if ($blog->status !== 'published') {
            abort(404);
        }
        return view('public.show', compact('blog'));
    }
}
