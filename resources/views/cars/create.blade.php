<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add a New Car</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* ===== Global Styling ===== */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      margin: 0;
      padding: 0;
      display: flex;
      min-height: 100vh;
    }

    /* ===== Sidebar ===== */
    #sidebar {
      width: 250px;
      background: #ffffff;
      border-right: 1px solid #e9ecef;
      padding: 20px 15px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      box-shadow: 2px 0 8px rgba(0, 0, 0, 0.05);
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

    /* ===== Main Content ===== */
    #main-content {
      margin-left: 250px;
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 20px;
    }

    /* ===== Top Navbar ===== */
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

    /* ===== Form Card ===== */
    .form-card {
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    .form-card h2 {
      font-size: 1.8rem;
      font-weight: bold;
      color: #0d6efd;
    }

    /* ===== Buttons ===== */
    .btn-primary {
      background-color: #0d6efd;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      transition: 0.3s;
    }

    .btn-primary:hover {
      background-color: #0b5ed7;
    }

    /* ===== Footer ===== */
    footer {
      margin-top: auto;
      background: #212529;
      color: #fff;
      padding: 12px 0;
      text-align: center;
      font-size: 14px;
    }

    /* ===== Responsive ===== */
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
      <h4><i class="fas fa-car"></i> Car Admin</h4>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
          <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('cars.index') }}">
          <i class="fas fa-car"></i> Manage Cars
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="{{ route('cars.create') }}">
          <i class="fas fa-plus"></i> Add New Car
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="fas fa-users"></i> Manage Users
        </a>
      </li>
      <hr class="text-dark">

      <li class="nav-item">
        <a class="nav-link" href="{{ route('purchases.index') }}">
          <i class="fas fa-users"></i> All Purchase
        </a>
      </li>
    </ul>
  </div>

  <!-- Main Content -->
  <div id="main-content">
    <!-- Top Navbar -->
    <div class="top-navbar">
      <h5>Add New Car</h5>
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
      </form>
    </div>

    <!-- Add Car Form -->
    <div class="container mt-4">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
          <div class="form-card">
            <h2 class="text-center mb-4">Add a New Car</h2>

            <!-- Success Message -->
            @if(session('success'))
              <div class="alert alert-success mb-4">
                {{ session('success') }}
              </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
              <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <!-- Form -->
            <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <!-- Car Brand -->
              <div class="mb-3">
                <label class="form-label">Car Brand</label>
                <select name="car_brand" class="form-select" required>
                  <option value="" disabled selected>Select a Car Brand</option>
                  <optgroup label="USA">
                    <option value="Ford">Ford</option>
                    <option value="Chevrolet">Chevrolet</option>
                    <option value="Tesla">Tesla</option>
                    <option value="Jeep">Jeep</option>
                    <option value="Dodge">Dodge</option>
                  </optgroup>
                  <optgroup label="Germany">
                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                    <option value="BMW">BMW</option>
                    <option value="Audi">Audi</option>
                    <option value="Volkswagen">Volkswagen</option>
                    <option value="Porsche">Porsche</option>
                  </optgroup>
                  <optgroup label="Japan">
                    <option value="Toyota">Toyota</option>
                    <option value="Honda">Honda</option>
                    <option value="Nissan">Nissan</option>
                    <option value="Mazda">Mazda</option>
                    <option value="Subaru">Subaru</option>
                  </optgroup>
                  <optgroup label="India">
                    <option value="Tata Motors">Tata Motors</option>
                    <option value="Mahindra">Mahindra</option>
                    <option value="Maruti Suzuki">Maruti Suzuki</option>
                  </optgroup>
                  <optgroup label="Italy">
                    <option value="Ferrari">Ferrari</option>
                    <option value="Lamborghini">Lamborghini</option>
                    <option value="Maserati">Maserati</option>
                  </optgroup>
                </select>
              </div>

              <!-- Car Model -->
              <div class="mb-3">
                <label class="form-label">Car Model</label>
                <select name="car_model" class="form-select" required>
                  <option value="" disabled selected>Select a Car Model</option>
                  <optgroup label="Toyota">
                    <option value="Corolla">Corolla</option>
                    <option value="Camry">Camry</option>
                    <option value="Fortuner">Fortuner</option>
                    <option value="Innova Crysta">Innova Crysta</option>
                    <option value="Land Cruiser">Land Cruiser</option>
                  </optgroup>
                  <optgroup label="Honda">
                    <option value="Civic">Civic</option>
                    <option value="Accord">Accord</option>
                    <option value="City">City</option>
                    <option value="Amaze">Amaze</option>
                    <option value="CR-V">CR-V</option>
                  </optgroup>
                  <optgroup label="BMW">
                    <option value="3 Series">3 Series</option>
                    <option value="5 Series">5 Series</option>
                    <option value="X5">X5</option>
                    <option value="X7">X7</option>
                  </optgroup>
                  <optgroup label="Tesla">
                    <option value="Model 3">Model 3</option>
                    <option value="Model S">Model S</option>
                    <option value="Model X">Model X</option>
                    <option value="Model Y">Model Y</option>
                  </optgroup>
                </select>
              </div>

              <!-- Price -->
              <div class="mb-3">
                <label class="form-label">Car Price</label>
                <input type="number" name="car_price" class="form-control" placeholder="Enter car price" step="50000" required>
              </div>

              <!-- Fuel Type -->
              <div class="mb-3">
                <label class="form-label">Fuel Type</label>
                <select name="car_fuel_type" class="form-select" required>
                  <option value="" disabled selected>Select fuel type</option>
                  <option value="Petrol">Petrol</option>
                  <option value="Diesel">Diesel</option>
                  <option value="Electric">Electric</option>
                  <option value="Hybrid">Hybrid</option>
                  <option value="CNG">CNG</option>
                </select>
              </div>

              <!-- Car Color -->
              <div class="mb-3">
                <label class="form-label">Car Color</label>
                <select name="car_color" class="form-select" required>
                  <option value="" disabled selected>Select Car Color</option>
                  <option value="Red">Red</option>
                  <option value="Blue">Blue</option>
                  <option value="Black">Black</option>
                  <option value="White">White</option>
                  <option value="Gray">Gray</option>
                  <option value="Golden">Golden</option>
                  <option value="Silver">Silver</option>
                  <option value="Green">Green</option>
                </select>
              </div>

              <!-- Year -->
              <div class="mb-3">
                <label class="form-label">Manufacture Year</label>
                <input type="date" name="year" class="form-control" required>
              </div>

              <!-- Owner Type -->
              <div class="mb-3">
                <label class="form-label">Owner Type</label>
                <select name="owner_type" class="form-select" required>
                  <option value="" disabled selected>Select owner type</option>
                  <option value="First Owner">First Owner</option>
                  <option value="Second Owner">Second Owner</option>
                  <option value="Third Owner">Third Owner</option>
                </select>
              </div>

              <!-- Car Image -->
              <div class="mb-4">
                <label class="form-label">Car Image</label>
                <input type="file" name="image" class="form-control">
              </div>

              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Add Car</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
      <p class="mb-0">&copy; {{ date('Y') }} CarShowroom. All Rights Reserved.</p>
    </footer>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
