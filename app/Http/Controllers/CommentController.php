<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store a new comment or reply for a blog post
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'body' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id'
        ]);
        $comment = $blog->comments()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id
        ]);
        $comment->load('user');
        if ($request->ajax()) {
            $html = view('comments._comment', compact('comment'))->render();
            return response()->json(['success' => true, 'html' => $html]);
        }
        return back()->with('success', 'Comment posted successfully!');
    }
}
