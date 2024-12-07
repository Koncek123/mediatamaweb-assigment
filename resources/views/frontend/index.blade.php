<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page - Articles</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://via.placeholder.com/1920x600') no-repeat center center/cover;
            color: white;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .article-card img {
            height: 200px;
            object-fit: cover;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }

        footer a {
            color: #ffc107;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero text-center">
        <div>
            <h1 class="display-4">Welcome to Our Articles</h1>
            <p class="lead">Stay updated with the latest news and stories.</p>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="container my-5">
        <h2 class="mb-4 text-center">Latest Articles</h2>
        <div class="row">
            @forelse ($articles as $article)
                <div class="col-md-4 mb-4">
                    <div class="card article-card">
                        <!-- Article Image -->
                        <img src="{{ $article->image_url ?? 'https://via.placeholder.com/350x200' }}" 
                             class="card-img-top" 
                             alt="{{ $article->title }}">
                        <div class="card-body">
                            <!-- Article Title -->
                            <h5 class="card-title">{{ $article->title }}</h5>
                            
                            <!-- Article Meta Information -->
                            <p class="text-muted mb-2">
                                <small>
                                    By: {{ $article->author->name ?? 'Unknown Author' }} 
                                    | {{ $article->created_at->format('d M Y') }}
                                </small>
                            </p>
                            
                            <!-- Article Excerpt -->
                            <p class="card-text text-muted">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            
                            <!-- Read More Button -->
                            <a href="{{ url('articles/'.$article->id) }}" class="btn btn-primary btn-sm">Read More</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No articles available at the moment.</p>
                </div>
            @endforelse
        </div>
    </section>
    

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-0">© 2024 Your Website. All rights reserved.</p>
            <p>
                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
