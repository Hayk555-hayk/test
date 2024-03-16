<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts - Blog Creation App</title>
    <link rel="stylesheet" href="styles.css">
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

        .post-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1rem;
        }

        .post {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            padding: 1rem;
            border-radius: 5px;
        }

        .post h2 {
            margin-bottom: 0.5rem;
        }

        .post p {
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: 1px solid #6c757d;
        }

        .btn:hover {
            background-color: #0056b3;
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
        <h1>Blog Posts</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Back</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="post-list">
            @foreach($posts as $post)
                <div class="post">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->author }}</p>
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-secondary">See more</a>
                </div>
            @endforeach
            <!-- Add more posts as needed -->
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Blog Creation App. All rights reserved.</p>
    </footer>
</body>
</html>

<p>posts {{$posts}}</p>
