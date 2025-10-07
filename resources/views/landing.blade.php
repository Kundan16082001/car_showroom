<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CarShowroom - Find Your Dream Car</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <style>
    /* General Reset */
    body {
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
      background-color: #f8f9fa;
    }

    /* Navbar */
    .navbar {
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      padding: 15px 0;
    }

    .navbar-brand {
      font-weight: 700;
      color: #007bff;
      font-size: 1.5rem;
    }

    .navbar-brand:hover {
      color: #0056b3;
    }

    .navbar-nav .nav-link {
      font-size: 1rem;
      padding: 10px 15px;
      transition: 0.3s;
    }

    .navbar-nav .nav-link:hover {
      color: #007bff;
    }

    /* Hero Section */
    .hero {
      background: url("{{ asset('storage/car.jpg') }}") no-repeat center center/cover;
      position: relative;
      min-height: 90vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
    }

    .hero::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: bold;
      margin-bottom: 15px;
    }

    .hero p {
      font-size: 1.2rem;
      margin-bottom: 25px;
    }

    /* CTA Buttons */
    .btn-primary, .btn-outline-light {
      padding: 12px 30px;
      font-size: 1rem;
      border-radius: 50px;
    }

    /* Section Styling */
    section {
      padding: 70px 0;
    }

    /* Why Choose Us */
    .why-choose-us h2 {
      font-weight: 700;
      margin-bottom: 40px;
    }

    .why-choose-us .icon-box {
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: 0.3s;
    }

    .why-choose-us .icon-box:hover {
      transform: translateY(-5px);
    }

    .why-choose-us i {
      font-size: 2.5rem;
      color: #007bff;
      margin-bottom: 15px;
    }

    /* Partners Section */
    .partners img {
      filter: grayscale(100%);
      opacity: 0.8;
      transition: 0.3s ease;
      max-height: 80px;
    }

    .partners img:hover {
      filter: grayscale(0%);
      opacity: 1;
    }

    /* Footer */
    footer {
      background: #222;
      color: #bbb;
      text-align: center;
      padding: 20px 0;
    }

    footer a {
      color: #bbb;
      text-decoration: none;
    }

    footer a:hover {
      color: #fff;
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
        <!-- Show Dashboard button only for logged-in admin -->
    @auth
        @if(Auth::user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link btn btn-warning text-dark px-4 ms-2" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                  <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-logout">
                      <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
              </li>
        @endif
    @endauth

    <!-- If no user is logged in, show Login button -->
    @guest
        <li class="nav-item">
            <a class="nav-link btn btn-primary text-white px-4 ms-2" href="{{ route('login') }}">
                <i class="fas fa-user"></i> Login
            </a>
        </li>
    @endguest
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero">
  <div class="hero-content">
    <h1>Find Your Dream Car</h1>
    <p>Explore our latest collection of luxury and budget-friendly cars.</p>
    <a href="{{ route('home') }}" class="btn btn-primary me-2">
      <i class="fas fa-search me-2"></i> Browse Inventory
    </a>
    <a href="{{ route('contact.form') }}" class="btn btn-outline-light">
      <i class="fas fa-phone me-2"></i> Contact Us
    </a>
  </div>
</section>

<!-- Why Choose Us -->
<section class="why-choose-us text-center">
  <div class="container">
    <h2>Why Choose Us?</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="icon-box">
          <i class="fas fa-star"></i>
          <h5>Trusted Brand</h5>
          <p>Delivering top-quality vehicles and services for over 15 years.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="icon-box">
          <i class="fas fa-tags"></i>
          <h5>Competitive Pricing</h5>
          <p>Best value with flexible financing options tailored for you.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="icon-box">
          <i class="fas fa-headset"></i>
          <h5>Exceptional Service</h5>
          <p>We ensure your buying experience is smooth and memorable.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Partners Section -->
<section class="partners bg-light">
  <div class="container text-center">
    <h2 class="mb-5">Our Trusted Partners</h2>
    <div class="row justify-content-center">
      <div class="col-6 col-md-2 mb-4">
        <img src="{{ asset('storage/toyota.png') }}" class="img-fluid" alt="Toyota">
      </div>
      <div class="col-6 col-md-2 mb-4">
        <img src="{{ asset('storage/suzuki.png') }}" class="img-fluid" alt="Suzuki">
      </div>
      <div class="col-6 col-md-2 mb-4">
        <img src="{{ asset('storage/mclaren.png') }}" class="img-fluid" alt="McLaren">
      </div>
      <div class="col-6 col-md-2 mb-4">
        <img src="{{ asset('storage/ford.png') }}" class="img-fluid" alt="Ford">
      </div>
      <div class="col-6 col-md-2 mb-4">
        <img src="{{ asset('storage/tata.webp') }}" class="img-fluid" alt="Tata">
      </div>
      <div class="col-6 col-md-2 mb-4">
        <img src="{{ asset('storage/mahindra.png') }}" class="img-fluid" alt="Mahindra">
      </div>
    </div>
  </div>
</section>


<!-- Footer -->
<footer>
  <p>&copy; {{ date('Y') }} CarShowroom. All rights reserved. | 
    <a href="{{ route('contact.form') }}">Contact</a>
  </p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
