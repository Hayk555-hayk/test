<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog APP</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
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

            main {
                padding: 2rem;
                height: 74vh;
            }

            .features {
                display: flex;
                justify-content: space-around;
                margin-bottom: 3rem;
            }

            .feature {
                text-align: center;
            }

            .feature i {
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            .cta {
                text-align: center;
            }

            .btn {
                display: inline-block;
                padding: 0.75rem 1.5rem;
                text-decoration: none;
                color: #fff;
                background-color: #007bff;
                border: 1px solid #007bff;
                border-radius: 5px;
                transition: background-color 0.3s ease;
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
    <body class="antialiased">
        <header>
            <h1>Welcome to the Blog Creation App</h1>
        </header>
        <main>
            <section class="features">
                <div class="feature">
                    <i class="fas fa-pen"></i>
                    <h2>Create</h2>
                    <p>Create and publish your blog posts easily.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-share-alt"></i>
                    <h2>Share</h2>
                    <p>Share your posts with the world and get feedback.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-chart-bar"></i>
                    <h2>Analyze</h2>
                    <p>Track your blog's performance with analytics.</p>
                </div>
            </section>
            <section class="cta">
                <h2>Ready to start blogging?</h2>
                <a href="{{ url('/posts') }}" class="btn btn-primary">Get Started</a>
            </section>
        </main>
        <footer>
            <p>&copy; 2024 Blog Creation App. All rights reserved.</p>
        </footer>
    </body>
</html>
