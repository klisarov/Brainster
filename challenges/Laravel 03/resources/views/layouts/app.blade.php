<!DOCTYPE html>
<html>
<head>
    <title>Brainster.xyz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logo_footer_black.png" alt="Brainster" height="32">
            </a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Академија за Програмирање</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Академија за Маркетинг</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Академија за Дизајн</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link hire-link" href="#" data-bs-toggle="modal" data-bs-target="#contactModal">
                            Вработи наши студенти
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="py-3">
        <div class="container text-center">
            Made with ❤️ by 
            <img src="/images/logo_footer_black.png" alt="Brainster" height="20">
            - <a href="https://facebook.com/brainster" target="_blank">Say Hi!</a> -
            <a href="#">Terms</a>
        </div>
    </footer>

    <!-- contact -->
    <div class="modal fade" id="contactModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вработи наши студенти</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted mb-4">Внесете Ваши информации за да стапиме во контакт:</p>
                    <form action="/contact" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Е-мејл" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control" placeholder="Телефон" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="company" class="form-control" placeholder="Компанија" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Испрати</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>