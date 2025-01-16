<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Clean Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-size: 20px;
            color: #212529;
            font-family: 'Lora', 'Times New Roman', serif;
        }

        p {
            line-height: 1.5;
            margin: 30px 0;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 800;
            font-family: 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .page-header {
            background-color: #868e96;
            background-attachment: scroll;
            position: relative;
            background-size: cover;
            background-position: center center;
            margin-bottom: 50px;
            padding: 200px 0 150px;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .header-content {
            position: relative;
            z-index: 1;
            color: white;
            text-align: center;
        }

        .header-content h1 {
            font-size: 50px;
            margin-top: 0;
        }

        .header-content .subtitle {
            font-size: 24px;
            font-weight: 300;
            margin: 10px 0 0;
        }

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 3;
            background: transparent !important;
            padding: 20px 0;
        }

        .navbar-brand {
            font-weight: 800;
        }

        .nav-link {
            text-transform: uppercase;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 10px 20px !important;
        }

        .post-meta {
            font-size: 18px;
            font-style: italic;
            margin-top: 0;
            color: white;
        }

        .floating-label-form-group {
            position: relative;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 20px;
        }

        .floating-label-form-group input,
        .floating-label-form-group textarea {
            font-size: 1.2em;
            position: relative;
            z-index: 1;
            padding-right: 0;
            padding-left: 0;
            resize: none;
            border: none;
            border-radius: 0;
            background: none;
            box-shadow: none !important;
        }

        .btn-primary {
            background-color: #0085A1;
            border-color: #0085A1;
            padding: 15px 25px;
            font-size: 14px;
            font-weight: 800;
        }

        .social-icons {
            text-align: center;
            margin: 30px 0;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            background: #333;
            color: white;
            text-align: center;
            margin: 0 5px;
            text-decoration: none;
        }

        footer {
            padding: 50px 0 65px;
            background-color: white;
        }

        .post-preview {
    margin-bottom: 30px;
}

.post-preview > a {
    color: #212529;
    text-decoration: none;
}

.post-preview > a:focus,
.post-preview > a:hover {
    color: #0085A1;
    text-decoration: none;
}

.post-preview > a > h2 {
    font-size: 30px;
    margin-top: 30px;
    margin-bottom: 10px;
}

.post-preview > a > h3.post-subtitle {
    font-weight: 300;
    margin: 0 0 10px;
    font-size: 24px;
}

.post-preview > .post-meta {
    font-size: 18px;
    font-style: italic;
    margin-top: 0;
    color: #6c757d;
}

.btn {
    font-size: 14px;
    font-weight: 800;
    padding: 15px 25px;
    letter-spacing: 1px;
    text-transform: uppercase;
    border-radius: 0;
    font-family: 'Open Sans', 'Helvetica Neue', Arial, sans-serif;
}

.btn-primary {
    background-color: #0085A1;
    border-color: #0085A1;
}

.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active {
    color: #fff;
    background-color: #00657b !important;
    border-color: #00657b !important;
}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog') }}">SAMPLE POST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">CONTACT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('header')
    
    <main class="container my-4">
        @yield('content')
    </main>

    <footer>
    <div class="social-icons">
    <a href="#" target="_blank"><i class="fab fa-twitter fa-fw"></i></a>
    <a href="#" target="_blank"><i class="fab fa-facebook-f fa-fw"></i></a>
    <a href="#" target="_blank"><i class="fab fa-github fa-fw"></i></a>
</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-code.js"></script>
</body>
</html>