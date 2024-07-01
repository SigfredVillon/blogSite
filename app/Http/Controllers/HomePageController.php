<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog; 

class HomePageController extends Controller
{
    public function index($filter = null)
    {
        switch ($filter) {
            case 'most-liked':
                $blogs = Blog::withCount('likes')->orderByDesc('likes_count')->get();
                break;
            case 'most-commented':
                $blogs = Blog::withCount('comments')->orderByDesc('comments_count')->get();
                break;
            case 'chronological':
                $blogs = Blog::orderBy('created_at', 'desc')->get();
                break;
            default:
                 $blogs = Blog::withCount('likes')->orderByDesc('likes_count')->get();
                break;
        }

        return view('dashboard', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        
        return view('show', compact('blog'));
    }
}
