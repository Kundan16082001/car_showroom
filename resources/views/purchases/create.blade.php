<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Purchase</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    <!-- Custom Dashboard CSS -->
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Sidebar */
        #sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            flex-shrink: 0;
            min-height: 100vh;
        }

        #sidebar .nav-link {
            color: white;
            padding: 10px 20px;
        }

        #sidebar .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        #sidebar .active {
            background-color: #007bff;
            color: white;
        }

        /* Main content */
        #main-content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        /* Card Styling */
        .card-shadow {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
     <!-- Sidebar -->
    <div id="sidebar">
        <div class="text-center mb-4">
            <h4 class="fw-bold"><i class="fas fa-car"></i> Car Admin</h4>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cars.index') }}">
                    <i class="fas fa-car"></i> Manage Cars
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('cars.create') }}">
                    <i class="fas fa-plus"></i> Add New Car
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('purchases.index') }}">
                    <i class="fas fa-shopping-cart"></i> Purchases
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-users"></i> Manage Users
                </a>
            </li>
            <hr>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('landing') }}">
                    <i class="fa-solid fa-house" style="color: #d8dadf;"></i> Go to home page
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <h5>Add New Purchase</h5>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <!-- Purchase Form -->
        <div class="container">
            <h2 class="mb-4">Buy Car</h2>

            <!-- Error Message -->
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card-shadow">
                <div class="card-body">
                    <h5>{{ $testDrive->car->car_brand }} {{ $testDrive->car->car_model }}</h5>
                    <p><strong>Price:</strong> ₹{{ number_format($testDrive->car->car_price, 2) }}</p>

                    <form action="{{ route('purchases.store') }}" method="get">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $testDrive->car->id }}">
                        <input type="hidden" name="test_drive_id" value="{{ $testDrive->id }}">

                        <div class="mb-3">
                            <label for="amount" class="form-label"><strong>Final Amount:</strong></label>
                            <input type="number" name="amount" id="amount" class="form-control" value="{{ $testDrive->car->car_price }}" readonly>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-shopping-cart"></i> Confirm Purchase
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-3 mt-4">
            <p class="mb-0">&copy; {{ date('Y') }} CarShowroom. All Rights Reserved.</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
