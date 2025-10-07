<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Purchases</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Global */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        #sidebar {
            width: 250px;
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            padding: 20px 15px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        }

        #sidebar h4 {
            font-weight: bold;
            color: #0d6efd;
        }

        #sidebar .nav-link {
            color: #333;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 6px;
            transition: 0.3s;
        }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        /* Main Content */
        #main-content {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Top Navbar */
        .top-navbar {
            background: #ffffff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .top-navbar h5 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        /* Table Styling */
        .table {
            background: #ffffff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table thead th {
            background-color: #0d6efd;
            color: #ffffff;
            text-align: center;
        }

        .table tbody td {
            vertical-align: middle;
            text-align: center;
        }

        /* Footer */
        footer {
            margin-top: auto;
            background: #212529;
            color: #fff;
            padding: 12px 0;
            text-align: center;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                width: 200px;
            }

            #main-content {
                margin-left: 200px;
            }
        }

        @media (max-width: 576px) {
            #sidebar {
                display: none;
            }

            #main-content {
                margin-left: 0;
            }
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
            <h5>My Purchases</h5>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <!-- My Purchases Table -->
        <div class="container py-4">
            <h4 class="mb-4">My Purchases</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($purchases->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Car</th>
                                <th>Purchase Date</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->car->car_brand }} {{ $purchase->car->car_model }}</td>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>₹{{ number_format($purchase->amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $purchase->payment_status === 'paid' ? 'success' : 'warning' }}">
                                            {{ ucfirst($purchase->payment_status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center">
                    You have not made any purchases yet.
                </div>
            @endif
        </div>

        <!-- Footer -->
        <footer>
            &copy; {{ date('Y') }} CarShowroom. All Rights Reserved.
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
