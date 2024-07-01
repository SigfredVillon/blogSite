<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Forum</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;        
            background: url('{{ asset('storage/bg.jpg') }}');
            background-repeat: repeat;
            background-size: auto;
            background-position: top left;
        }
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
        .content {
            max-width: 800px;
            margin: 20px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex; 
            flex-wrap: wrap; 
            align-items: flex-start; 
        }
        .title {
            width: 100%;
            font-size: 32px;
            margin-bottom: 10px;
        }
        .placeholder-image {
            max-width: 400px; 
            width: 100%;
            height: auto;
            margin-bottom: 20px; 
        }
        .lorem-ipsum {
            width: calc(100% - 420px); 
            font-size: 20px;
            line-height: 1.6;
            margin-left: 20px;
        }
        .filters {
            margin-bottom: 20px;
        }
        .filters a {
            margin-right: 10px;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
        }
        .filters .most-liked {
            background-color: #38c172;
        }
        .filters .most-commented {
            background-color: #ffed4a;
        }
        .filters .chronological {
            background-color: #3490dc;
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
        }
        .blog-item p {
            margin-bottom: 10px;
        }
        .blog-item .details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .blog-item .details .buttons a {
            margin-right: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: #fff;
        }
        .blog-item .details .buttons .check-it-out {
            background-color: #3490dc;
        }
        .blog-item .details .stats span {
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="header">
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @else
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endguest
    </div>

    <div class="content">
        <h1 class="title"> &nbsp;  &nbsp; &nbsp; What is Open Forum?</h1>

        <img src="{{ asset('storage/openForum.png') }}" alt="Open Forum Image" class="placeholder-image">

        <p class="lorem-ipsum">
            Welcome to Open Forum, your personalized platform for sharing ideas, stories, and insights with the world. At Open Forum, we empower users to create, edit, and manage their own blogs effortlessly. Whether you're passionate about technology, arts, lifestyle, or any niche in between, OpenForum provides a seamless experience for expressing your thoughts and engaging with a community of like-minded individuals.
        </p>
    </div>

    <div class="content">
        <!-- Filters -->
        <div class="filters">
            <a href="{{ route('welcome.filter', 'most-liked') }}" class="most-liked">Most Liked</a>
            <a href="{{ route('welcome.filter', 'most-commented') }}" class="most-commented">Most Commented</a>
            <a href="{{ route('welcome.filter', 'chronological') }}" class="chronological">Chronological</a>
        </div>

        @if($blogs->isEmpty())
            <p>No blogs available.</p>
        @else
            @foreach ($blogs as $blog)
                <div class="blog-item">
                    <h3>{{ $blog->title }}</h3>
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image">
                    @endif
                    @php
                        $sentences = explode('.', $blog->content);
                        $first_sentence = $sentences[0];
                    @endphp
                    <p>{{ $first_sentence }}</p>

                    <div class="details">
                        <div class="buttons">
                            <a href="{{ route('guestShow', $blog) }}" class="check-it-out">Check it out</a>
                        </div>
                        <div class="stats">
                            <span>{{ $blog->likes->count() }} likes</span>
                            <span>{{ $blog->comments->count() }} comments</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

</body>
</html>
