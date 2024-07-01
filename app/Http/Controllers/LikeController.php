<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Like;

use Illuminate\Support\Facades\Auth; 

class LikeController extends Controller
{
    public function store(Blog $blog)
    {
        $like = Like::firstOrCreate([
            'user_id' => auth()->id(),
            'blog_id' => $blog->id,
        ]);

        return back();
    }

    public function destroy(Blog $blog)
    {
        $blog->likes()->where('user_id', auth()->id())->delete();

        return back();
    }

    public function likedPosts()
    {
        $user = Auth::user();
        $blogs = $user->likedBlogs()->get();

        return view('likedPosts', compact('blogs'));
    }
}
