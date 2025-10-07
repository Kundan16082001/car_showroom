<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar */
        #sidebar {
            background: #343a40;
            min-height: 100vh;
            color: #fff;
            padding: 20px 0;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
        }

        #sidebar h4 {
            color: #fff;
            margin-bottom: 20px;
            font-weight: bold;
        }

        #sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 20px;
            display: block;
            transition: 0.3s;
        }

        #sidebar a:hover, #sidebar a.active {
            background: #007bff;
            color: #fff;
            border-radius: 5px;
        }

        /* Main Content */
        #main-content {
            margin-left: 250px;
            padding: 30px;
        }

        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table th {
            background: #007bff !important;
            color: #fff;
        }

        table td {
            vertical-align: middle;
        }

        .btn-sm {
            padding: 4px 10px;
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
            <h3>User Management</h3>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
        </div>

        <!-- User Table -->
        <div class="card">
            <div class="card-body">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Add New User
                </a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Profile Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-capitalize">{{ $user->role }}</td>
                                <td>
                                    @if($user->image)
                                        <img src="{{ asset('storage/' . $user->image) }}" width="50" height="50" class="rounded-circle">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
