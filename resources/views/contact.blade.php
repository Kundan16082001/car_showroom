<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - CarShowroom</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=1500&q=80') no-repeat center center/cover;
      min-height: 100vh;
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

    /* Contact Section */
    .contact-section {
      background: rgba(255,255,255,0.92);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      margin: 80px auto;
      max-width: 600px;
    }

    .contact-section h2 {
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
    }

    .form-group label {
      font-weight: 600;
    }

    .form-control {
      padding: 12px;
      border-radius: 8px;
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 12px;
      font-size: 1rem;
      width: 100%;
      border-radius: 50px;
      transition: 0.3s;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    /* Success message */
    .alert-success {
      margin-top: 15px;
      border-radius: 8px;
    }

    /* Footer */
    footer {
      background: #212529;
      color: #fff;
      text-align: center;
      padding: 12px 0;
      position: fixed;
      bottom: 0;
      width: 100%;
      box-shadow: 0 -2px 8px rgba(0,0,0,0.12);
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

<!-- Contact Section -->
<div class="container">
  <div class="contact-section">
    <h2><i class="fas fa-envelope"></i> Contact Us</h2>

    <!-- Success Message -->
    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
      </div>
    @endif

    <!-- Contact Form -->
    <form action="{{ route('contact.submit') }}" method="POST">
      @csrf

      <div class="mb-3 form-group">
        <label for="name">Name *</label>
        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your full name" required>
      </div>

      <div class="mb-3 form-group">
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>

      <div class="mb-3 form-group">
        <label for="subject">Subject *</label>
        <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter the subject" required>
      </div>

      <div class="mb-3 form-group">
        <label for="message">Message *</label>
        <textarea id="message" name="message" class="form-control" rows="4" placeholder="Write your message here" required></textarea>
      </div>

      <button type="submit" class="btn btn-primary">
        <i class="fas fa-paper-plane"></i> Send Message
      </button>
    </form>
  </div>
</div>
<br>
<br>

<!-- Footer -->
<footer>
  &copy; {{ date('Y') }} CarShowroom. All rights reserved.
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
