<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Drive Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Test Drive Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($testDrives->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Car</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testDrives as $drive)
                        <tr>
                            <td>{{ $drive->id }}</td>
                            <td>{{ $drive->user->name }} ({{ $drive->user->email }})</td>
                            <td>{{ $drive->car->car_brand }} - {{ $drive->car->car_model }}</td>
                            <td>{{ $drive->preferred_date }}</td>
                            <td>{{ $drive->preferred_time }}</td>
                            <td>
                                <span class="badge bg-{{ $drive->status == 'approved' ? 'success' : ($drive->status == 'completed' ? 'info' : 'warning') }}">
                                    {{ ucfirst($drive->status) }}
                                </span>
                            </td>
                            <td>{{ $drive->notes ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('testdrives.updateStatus', $drive->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select me-2">
                                        <option value="pending" {{ $drive->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $drive->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="completed" {{ $drive->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                    <button class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">No test drive bookings yet.</div>
    @endif
</div>

</body>
</html>
