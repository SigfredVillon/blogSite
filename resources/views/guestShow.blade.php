<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Details</title>
    <style>
        .header {
            background-color: rgba(52, 144, 220, 0.8);
            color: #fff;
            padding: 10px;
            text-align: right;
        }
        .header a {
            color: #fff;
            text-decoration: none;
            margin-left: 10px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('{{ asset('storage/bg.jpg') }}');
            background-repeat: repeat;
            background-size: auto;
            background-position: top left;
        }
        .content {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        
            background-size: cover;
        }
        .blog-item {
            border: 1px solid #3490dc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #e0f2f1;
        }
        .blog-item h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .blog-item img {
            max-width: 200px;
            margin-bottom: 10px;
            border-radius: 10px;
        }
        .blog-item p {
            margin-bottom: 10px;
        }
        .details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stats span {
            color: #6c757d;
        }
        .comments {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .comments h4 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .comment:last-child {
            border-bottom: none;
        }
        .comment strong {
            display: block;
            margin-bottom: 5px;
        }
        .comment span {
            color: #6c757d;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        @guest
        <a href="{{ route('welcome') }}">Home</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @else
            <a href="{{ route('dashboard') }}">Login</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endguest
    </div>

    <div class="content">
        <div class="blog-item">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image">
            @endif
            <h3>{{ $blog->title }}</h3>
            <p>{{ $blog->content }}</p>
            <div class="details">
                <div class="stats">
                    <span>{{ $blog->likes->count() }} likes</span>
                </div>
                <div>
                    <p class="text-gray-500 text-sm mt-2">
                        Posted {{ $blog->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>

        <div class="comments">
            <h4>Comments</h4>
            @foreach($blog->comments->sortByDesc('created_at') as $comment)
                <div class="comment">
                    <strong>{{ $comment->user->name }}</strong>
                    <span>{{ $comment->created_at->diffForHumans() }}</span>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
