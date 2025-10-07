<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Car Showroom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Sidebar */
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
        #sidebar .nav-link.active,
        #sidebar .nav-link:hover {
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        /* Main content */
        #main-content {
            margin-left: 250px;
            padding: 20px;
            background-color: #f8f9fc;
            min-height: 100vh;
        }

        /* Top Navbar */
        .top-navbar {
            background: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .top-navbar h5 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        /* Footer */
        footer {
            margin-top: 40px;
            background: #343a40;
            color: white;
            padding: 15px;
        }

        /* Table styling */
        .table thead th {
            background-color: #4e73df;
            color: #fff;
            text-align: center;
        }
        .table tbody td {
            text-align: center;
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
            <h5>Dashboard</h5>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Dashboard Overview -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Cars</h6>
                        <h3>{{ $totalCars }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Test Drives</h6>
                        <h3>{{ $totalTestDrives }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Purchases</h6>
                        <h3>{{ $totalPurchases }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Users</h6>
                        <h3>{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booked Test Drives Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-calendar-check"></i> Booked Test Drives</h5>
            </div>
            <div class="card-body">
                @if($testDrives->isEmpty())
                    <p class="text-center">No test drives booked yet.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Car</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Update Status</th>
                                <th>Buy Now</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testDrives as $testDrive)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $testDrive->user->name }}</td>
                                    <td>{{ $testDrive->car->car_brand }} {{ $testDrive->car->car_model }}</td>
                                    <td>{{ $testDrive->preferred_date }}</td>
                                    <td>{{ $testDrive->preferred_time }}</td>
                                    <td>
                                        <span class="badge bg-{{ $testDrive->status === 'pending' ? 'warning' : ($testDrive->status === 'approved' ? 'info' : 'success') }}">
                                            {{ ucfirst($testDrive->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('testdrives.updateStatus', $testDrive->id) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" class="form-select me-2">
                                                <option value="pending" {{ $testDrive->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ $testDrive->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="completed" {{ $testDrive->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        @if($testDrive->status === 'approved')
                                            <a href="{{ route('purchases.create', ['testDriveId' => $testDrive->id]) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-shopping-cart"></i> Buy Now
                                            </a>
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                <i class="fas fa-ban"></i> Buy Now
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Purchases Table -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> All Purchases</h5>
            </div>
            <div class="card-body">
                @if($purchases->isEmpty())
                    <p class="text-center">No purchases recorded yet.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer</th>
                                <th>Car</th>
                                <th>Amount</th>
                                <th>Purchase Date</th>
                                <th>Payment Status</th>
                                <th>Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $purchase->user->name }}</td>
                                    <td>{{ $purchase->car->car_brand }} {{ $purchase->car->car_model }}</td>
                                    <td>₹{{ number_format($purchase->amount) }}</td>
                                    <td>{{ $purchase->purchase_date }}</td>
                                    <td>
                                        <span class="badge bg-{{ $purchase->payment_status === 'paid' ? 'success' : 'warning' }}">
                                            {{ ucfirst($purchase->payment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('purchases.updateStatus', $purchase->id) }}" method="POST" class="d-flex">
                                            @csrf
                                            @method('PATCH')
                                            <select name="payment_status" class="form-select me-2">
                                                <option value="pending" {{ $purchase->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="paid" {{ $purchase->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Users Table -->
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fas fa-users"></i> Registered Users</h5>
            </div>
            <div class="card-body">
                @if($users->isEmpty())
                    <p class="text-center">No users registered yet.</p>
                @else
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-capitalize">{{ $user->role }}</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center">
            <p class="mb-0">&copy; {{ date('Y') }} CarShowroom. All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>
