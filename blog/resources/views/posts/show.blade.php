<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Blog Creation App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            display: inline-block;
            margin-right: 20px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
        }

        main {
            padding: 2rem;
            min-height: 74vh;
        }

        .single-post {
            max-width: 800px;
            margin: 0 auto;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 1rem;
        }

        .post-content p {
            line-height: 1.6;
        }

        .post-meta {
            margin-top: 1rem;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }

    </style>
</head>
<body>
    <header>
        <h1>{{ $post->title }}</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/posts') }}">Back</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <article class="single-post">
            <div class="post-content">
                <p>{{ $post->author }}</p>
            </div>
            <div class="post-meta">
                <p>Published on: {{ $post->created_at->format('M d, Y') }}</p>
                <p>Publication yeat: {{ $post->publication_year }}</p>
            </div>
        </article>
    </main>
    <footer>
        <p>&copy; 2024 Blog Creation App. All rights reserved.</p>
    </footer>
</body>
</html>
