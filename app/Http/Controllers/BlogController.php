<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    // Fetch blogs with search, tag filters, and pagination
    public function index(Request $request)
    {
        $query = Blog::with('user')->latest();
        $query->when($request->search, function ($q, $search) {
            $q->where('title', 'like', "%{$search}%");
        });
        $query->when($request->tag, function ($q, $tags) {
            $tagsArray = explode(',', $tags);
            $q->where(function ($sub) use ($tagsArray) {
                foreach ($tagsArray as $tag) {
                    $sub->orWhere('tags', 'like', '%' . trim($tag) . '%');
                }
            });
        });
        $blogs = $query->paginate(10)->withQueryString();
        return view('blogs.index', compact('blogs'));
    }

    // Display single blog with nested comments and replies
    public function show(Blog $blog)
    {
        $blog->load(['user', 'comments' => fn($q) => 
            $q->whereNull('parent_id')->with('replies', 'user')
        ]);
        return view('blogs.show', compact('blog'));
    }

    // Show form to create a new blog
    public function create()
    {
        return view('blogs.create');
    }

    // Validate and store a new blog post
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|string'
        ], [
            'title.required' => 'A blog title is required.',
            'content.required' => 'Please write some content.'
        ]);
        Auth::user()->blogs()->create($data);
        return redirect()->route('blogs.index')->with('success', 'Blog created!');
    }

    // Show edit form if the user is authorized
    public function edit(Blog $blog)
    {
        abort_if(auth()->id() !== $blog->user_id, 403);
        return view('blogs.edit', compact('blog'));
    }

    // Update blog details after ownership check
    public function update(Request $request, Blog $blog)
    {
        abort_if(auth()->id() !== $blog->user_id, 403);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tags' => 'nullable|string'
        ]);
        $blog->update($data);
        return redirect()->route('blogs.show', $blog->id)->with('success', 'Updated!');
    }

    // Remove the blog from database
    public function destroy(Blog $blog)
    {
        abort_if(auth()->id() !== $blog->user_id, 403);
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Deleted!');
    }

    // Handle AJAX like/unlike toggle and return JSON
    public function toggleLike(Blog $blog)
    {
        $like = $blog->likes()->where('user_id', auth()->id())->first();
        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $blog->likes()->create(['user_id' => auth()->id()]);
            $isLiked = true;
        }
        return response()->json([
            'success' => true,
            'isLiked' => $isLiked,
            'likesCount' => $blog->likes()->count()
        ]);
    }
}