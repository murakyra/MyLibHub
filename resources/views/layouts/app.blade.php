<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyLibHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-halaman: #a5dbebff;      
            --bg-navbar: #ffffff;       
            --warna-teks-nav: #333333;  
            --shadow-nav: 0 2px 10px rgba(0,0,0,0.05); 
        }

        body {
            background-color: var(--bg-halaman);
            min-height: 100vh;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .navbar-custom {
            background-color: var(--bg-navbar) !important;
            box-shadow: var(--shadow-nav);
            padding: 12px 0;
        }

        .navbar-custom .nav-link {
            color: var(--warna-teks-nav) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #0d6efd !important; 
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('books.index') }}">
                <img 
                    src="{{ asset('images/logo.png') }}" 
                    alt="MyLibHub Logo" 
                    style="height: 40px; width: auto;"
                >
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>