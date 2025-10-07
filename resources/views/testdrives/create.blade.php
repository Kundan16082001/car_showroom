<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Test Drive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: #f8f9fa;">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ route('landing') }}">CarShowroom</a>
    </div>
</nav>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h3 class="text-center text-primary mb-4">Book a Test Drive</h3>

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('testdrives.store') }}" method="POST">
                        @csrf

                        <!-- Car Selection -->
                        <div class="mb-3">
                            <label for="car_id" class="form-label">Select Car</label>
                            <select class="form-select" name="car_id" id="car_id" required>
                                <option value="" disabled selected>-- Select a Car --</option>
                                @foreach($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->car_brand }} - {{ $car->car_model }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label for="preferred_date" class="form-label">Preferred Date</label>
                            <input type="date" class="form-control" id="preferred_date" name="preferred_date" required min="{{ date('Y-m-d') }}">
                        </div>

                        <!-- Time -->
                        <div class="mb-3">
                            <label for="preferred_time" class="form-label">Preferred Time</label>
                            <input type="time" class="form-control" id="preferred_time" name="preferred_time" required>
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label for="notes" class="form-label">Additional Notes (Optional)</label>
                            <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Book Test Drive</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; {{ date('Y') }} CarShowroom. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
