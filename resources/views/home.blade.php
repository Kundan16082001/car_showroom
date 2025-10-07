<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Cars - CarShowroom</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* Global Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Navbar */
        .navbar {
            background: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
        }

        .navbar-brand {
            color: #007bff !important;
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }

        .navbar-brand i {
            margin-right: 8px;
        }

        .nav-link {
            color: #333 !important;
            font-weight: 500;
            transition: color 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: #007bff !important;
        }

        .navbar-text strong {
            color: #007bff;
        }

        /* Logout Button */
        .btn-logout {
            background-color: #dc3545;
            color: #fff;
            border-radius: 6px;
            font-size: 0.85rem;
            padding: 6px 12px;
            transition: background-color 0.3s ease-in-out;
            border: none;
        }

        .btn-logout:hover {
            background-color: #b52a37;
        }

        /* Section Heading */
        .section-heading {
            color: #333;
            text-align: center;
            margin-bottom: 40px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        /* Car Cards */
        .car-card {
            background: #fff;
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        }

        .car-card img {
            height: 200px;
            object-fit: cover;
            width: 100%;
            border-bottom: 1px solid #f1f1f1;
        }

        .car-card .card-body {
            padding: 15px;
        }

        .car-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #28a745;
            margin-bottom: 8px;
        }

        .card-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }

        .btn-primary, .btn-success {
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 6px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Empty Data Alert */
        .alert-info {
            background-color: rgba(0,123,255,0.05);
            border: 1px solid #007bff;
            color: #007bff;
            font-weight: 500;
        }

        /* Footer */
        footer {
            background: #ffffff;
            border-top: 1px solid #eaeaea;
            color: #555;
            padding: 20px 0;
            margin-top: 40px;
            text-align: center;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Adjustments */
        @media (max-width: 576px) {
            .car-card img {
                height: 160px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('landing') }}">
                <i class="fas fa-car"></i> CarShowroom
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item">
                            <span class="navbar-text me-3">Welcome, <strong>{{ Auth::user()->name }}</strong></span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-logout">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <h2 class="section-heading">Available Cars</h2>
        <div class="row g-4">
            @if($cars->count() > 0)
                @foreach($cars as $car)
                    <div class="col-md-4 col-lg-3">
                        <div class="card car-card">
                            @if($car->image)
                                <img src="{{ asset('storage/'.$car->image) }}" alt="{{ $car->car_brand }}">
                            @else
                                <img src="https://via.placeholder.com/300x200.png?text=No+Image" alt="No Image">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $car->car_brand }} {{ $car->car_model }}</h5>
                                <p class="car-price">₹{{ number_format($car->car_price, 2) }}</p>
                                <p class="card-text mb-2">
                                    <strong>Fuel:</strong> {{ $car->car_fuel_type }} <br>
                                    <strong>Color:</strong> {{ $car->car_color }}
                                </p>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                    <a href="{{ route('testdrives.create', $car->id) }}" class="btn btn-success">
                                        <i class="fas fa-calendar-check"></i> Book Test Drive
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No cars available at the moment. Please check back later.
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} CarShowroom. All Rights Reserved. | <a href="#">Privacy Policy</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
