<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - CarShowroom</title>

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

        /* Signup Form */
        .signup-container {
            background: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 12px;
            max-width: 480px;
            margin: auto;
            box-shadow: 0 8px 32px rgba(31,38,135,0.37);
        }

        .signup-container h3 {
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-control, .form-select {
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

        .btn-reset {
            width: 100%;
            border-radius: 50px;
            padding: 10px;
            font-size: 1rem;
            font-weight: 600;
            background-color: #dc3545;
            border: none;
            transition: 0.3s ease-in-out;
        }

        .btn-reset:hover {
            background-color: #b52a37;
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

        /* Alerts */
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
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white ms-2 px-4" href="{{ route('login') }}">
                        <i class="fas fa-user"></i> Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Signup Form -->
<div class="container" style="margin-top: 120px;">
    <div class="signup-container">
        <h3><i class="fas fa-user-plus"></i> Signup</h3>

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

        <form action="{{ route('signup.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fas fa-user"></i> Username</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="@username" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="your@email.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********" minlength="6" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="********" minlength="6" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label"><i class="fas fa-user-tag"></i> Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Register
                </button>
                <button type="reset" class="btn btn-reset">
                    <i class="fas fa-redo"></i> Reset
                </button>
            </div>

            <p class="text-center mt-3 mb-0">
                Already have an account?
                <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Login here</a>
            </p>
        </form>
    </div>
</div>
<br>

<!-- Footer -->
<footer>
    &copy; {{ date('Y') }} CarShowroom. All rights reserved.
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
