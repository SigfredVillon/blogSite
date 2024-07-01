<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use App\Models\Blog; 

class BlogController extends Controller
{
    public function myBlogs($filter = null)
    {
        $blogs = Blog::where('user_id', Auth::id())->get();
    
        switch ($filter) {
            case 'most-liked':
                $blogs->loadCount('likes')->sortByDesc('likes_count');
                break;
            case 'most-commented':
                $blogs->loadCount('comments')->sortByDesc('comments_count');
                break;
            case 'chronological':
                $blogs->sortByDesc('created_at');
                break;
            default:
                 $blogs->loadCount('likes')->sortByDesc('likes_count');                
                 break;
        }
    
        return view('myBlogs.myBlogs', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('myBlogs.show', compact('blog'));
    }

    public function create()
    {
        return view('myBlogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|nullable',
        ]);

        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $blog->image = $path;
        }

        $blog->save();

        return redirect()->route('myBlogs');
    }

    public function edit(Blog $blog)
    {
        if ($blog->user_id != Auth::id()) {
            abort(403);
        }

        return view('myBlogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        if ($blog->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'image|nullable',
        ]);

        $blog->title = $request->title;
        $blog->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $blog->image = $path;
        }

        $blog->save();

        return redirect()->route('myBlogs');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->user_id != Auth::id()) {
            abort(403);
        }

        $blog->delete();

        return redirect()->route('myBlogs');
    }
}
