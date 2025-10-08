<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BlogAdminController extends Controller
{
    
    public function index()
    {   
        $blogs = Blog::orderBy('created_at','desc')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024', // max KB => 1 MB
            'status' => 'required|in:pending,published,rejected',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.Str::slug($request->title).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $data['image'] = 'uploads/blogs/'.$filename;
        }

        $data['user_id'] = Auth::id();

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success','Blog created.');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'status' => 'required|in:pending,published,rejected',
        ]);

        if ($request->hasFile('image')) {
            // delete old file if exists
            if ($blog->image && file_exists(public_path($blog->image))) {
                unlink(public_path($blog->image));
            }
            $file = $request->file('image');
            $filename = time().'_'.Str::slug($request->title).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/blogs'), $filename);
            $data['image'] = 'uploads/blogs/'.$filename;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success','Blog updated.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && file_exists(public_path($blog->image))) {
            unlink(public_path($blog->image));
        }
        $blog->delete();
        return back()->with('success','Deleted.');
    }

    // AJAX status update
    public function updateStatus(Request $request, Blog $blog)
    {
        $request->validate([
            'status' => 'required|in:pending,published,rejected'
        ]);

        $blog->status = $request->status;
        $blog->save();

        return response()->json(['success' => true, 'status' => $blog->status]);
    }
}
