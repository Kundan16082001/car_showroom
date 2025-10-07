<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        #sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #4e73df 0%, #224abe 100%);
            color: #fff;
            padding-top: 20px;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }
        #sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 10px 20px;
            transition: background 0.3s;
        }
        #sidebar .nav-link:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }
        #main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fc;
            min-height: 100vh;
        }
        .top-navbar {
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .top-navbar h5 {
            margin: 0;
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
            <h5>Car Inventory</h5>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <div class="text-end mb-3">
                        <a href="{{ route('cars.create') }}" class="btn btn-primary">+ Add New Car</a>
                    </div>

                    <div class="card shadow-lg">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Price</th>
                                        <th>Fuel</th>
                                        <th>Color</th>
                                        <th>Year</th>
                                        <th>Owner</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cars as $car)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $car->car_brand }}</td>
                                            <td>{{ $car->car_model }}</td>
                                            <td>₹{{ number_format($car->car_price, 2) }}</td>
                                            <td>{{ $car->car_fuel_type }}</td>
                                            <td>{{ $car->car_color }}</td>
                                            <td>{{ \Carbon\Carbon::parse($car->year)->format('Y') }}</td>
                                            <td>{{ $car->owner_type }}</td>
                                            <td>
                                                @if($car->image)
                                                    <img src="{{ asset('storage/'.$car->image) }}" width="80" class="img-thumbnail">
                                                @else
                                                    <span class="text-muted">No image</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ route('cars.destroy', $car->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this car?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center text-muted">No cars available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>
