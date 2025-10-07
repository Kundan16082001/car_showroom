<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CarShowroom</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: url('https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=1500&q=80') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .navbar-brand {
            font-weight: 700;
            color: #007bff;
        }

        .navbar-brand:hover {
            color: #0056b3;
        }

        /* Login Card */
        .login-container {
            background: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 12px;
            max-width: 420px;
            margin: auto;
            box-shadow: 0 8px 32px rgba(31,38,135,0.37);
        }

        .login-container h3 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control {
            padding: 12px;
            border-radius: 8px;
        }

        .btn-primary {
            width: 100%;
            border-radius: 50px;
            padding: 10px;
            font-size: 1rem;
            font-weight: 600;
            background-color: #007bff;
            border: none;
            transition: 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .password-toggle {
            margin-top: 8px;
            font-size: 0.9rem;
        }

        /* Footer */
        footer {
            background: #212529;
            color: #fff;
            text-align: center;
            padding: 12px 0;
            margin-top: auto;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.12);
        }

        /* Error & Success Alerts */
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">
            <i class="fas fa-car"></i> CarShowroom
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('landing') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Cars</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact.form') }}">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('signup.create') }}">Signup</a></li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white ms-2 px-4" href="{{ route('login') }}">
                        <i class="fas fa-user"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Login Form Section -->
<div class="container" style="margin-top: 120px;">
    <div class="login-container">
        <h3><i class="fas fa-sign-in-alt"></i> Login</h3>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="your@email.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="••••••••" required>
                <div class="password-toggle">
                    <input type="checkbox" onclick="togglePassword()"> Show password
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Login
            </button>
        </form>

        <p class="text-center mt-3 mb-0">
            Don't have an account?
            <a href="{{ route('signup.create') }}" class="fw-bold text-decoration-none">Sign up here</a>
        </p>
    </div>
</div>

<!-- Footer -->
<footer>
    &copy; {{ date('Y') }} CarShowroom. All rights reserved.
</footer>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const password = document.getElementById('password');
        password.type = password.type === 'password' ? 'text' : 'password';
    }
</script>
</body>
</html>
