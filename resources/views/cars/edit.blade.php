<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Car Details</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Car Brand</label>
            <input type="text" name="car_brand" value="{{ $car->car_brand }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Car Model</label>
            <input type="text" name="car_model" value="{{ $car->car_model }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Car Price</label>
            <input type="number" name="car_price" value="{{ $car->car_price }}" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fuel Type</label>
            <input type="text" name="car_fuel_type" value="{{ $car->car_fuel_type }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Car Color</label>
            <input type="text" name="car_color" value="{{ $car->car_color }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Manufacture Year</label>
            <input type="date" name="year" value="{{ $car->year }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Owner Type</label>
            <input type="text" name="owner_type" value="{{ $car->owner_type }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Car Image</label><br>
            @if($car->image)
                <img src="{{ asset('storage/'.$car->image) }}" alt="Car Image" width="100" class="img-thumbnail mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Update Car</button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
