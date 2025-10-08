<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // Admin: show all blogs with counts
            $totalBlogs = Blog::count();
            $pending = Blog::where('status', 'pending')->count();
            $published = Blog::where('status', 'published')->count();
            $rejected = Blog::where('status', 'rejected')->count();

            return view('dashboard.admin', compact('user', 'totalBlogs', 'pending', 'published', 'rejected'));
        } else {
            // Regular user: show only their blogs
            $blogs = $user->blogs()->latest()->get();
            return view('dashboard.user', compact('user', 'blogs'));
        }
    }
}
