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

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            min-height: 74vh;
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

        .single-post {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        .alert-danger {
            color: red;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
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
        <h1>{{ $post->title }}</h1>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('/posts') }}">Back</a></li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <article class="single-post">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" class="post-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
                </div>
                <div class="form-group">
                    @error('author')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ $post->author }}">
                </div>
                <div class="form-group">
                    @error('publication_year')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="publication_year">Publication Year</label>
                    <input type="number" class="form-control" id="publication_year" name="publication_year" value="{{ $post->publication_year }}">
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
            </form>
        </article>
    </main>
    <footer>
        <p>&copy; 2024 Blog Creation App. All rights reserved.</p>
    </footer>
</body>
</html>
