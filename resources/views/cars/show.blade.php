<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Car Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">
            <h3>{{ $car->car_brand }} - {{ $car->car_model }}</h3>
        </div>
        <div class="card-body">
            @if($car->image)
                <img src="{{ asset('storage/'.$car->image) }}" class="img-fluid mb-3" style="max-width: 600px;justify-content: center;">
            @else
                <p class="text-muted">No image available</p>
            @endif

            <ul class="list-group">
                <li class="list-group-item"><strong>Price:</strong> ₹{{ number_format($car->car_price, 2) }}</li>
                <li class="list-group-item"><strong>Fuel Type:</strong> {{ $car->car_fuel_type }}</li>
                <li class="list-group-item"><strong>Color:</strong> {{ $car->car_color }}</li>
                <li class="list-group-item"><strong>Year:</strong> {{ \Carbon\Carbon::parse($car->year)->format('Y') }}</li>
                <li class="list-group-item"><strong>Owner:</strong> {{ $car->owner_type }}</li>
            </ul>

            <div class="mt-3">
                <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ route('testdrives.create', $car->id) }}" class="btn btn-success"><i class="fas fa-calendar-check"></i> Book Test Drive</a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
