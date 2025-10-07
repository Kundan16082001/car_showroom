<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestDrive;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class TestDriveController extends Controller
{
    // Show booking form
    public function create()
    {
        $cars = Car::all();
        return view('testdrives.create', compact('cars'));
    }

    // Store booking
    public function store(Request $request)
    {
        $request->validate([
            'car_id'          => 'required|exists:cars,id',
            'preferred_date'  => 'required|date|after_or_equal:today',
            'preferred_time'  => 'required',
            'notes'           => 'nullable|string|max:255',
        ]);

        TestDrive::create([
            'user_id'         => Auth::id(),
            'car_id'          => $request->car_id,
            'preferred_date'  => $request->preferred_date,
            'preferred_time'  => $request->preferred_time,
            'notes'           => $request->notes,
            'status'          => 'pending',
        ]);

        return redirect()->route('testdrives.create')
                         ->with('success', 'Test drive booked successfully!');
    }

    // Admin view all bookings
    public function index()
    {
        $testDrives = TestDrive::with(['user', 'car'])->latest()->get();
        return view('testdrives.index', compact('testDrives'));
    }

    // Admin update booking status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,completed',
        ]);

        $testDrive = TestDrive::findOrFail($id); // ✅ Corrected line
        $testDrive->status = $request->status;
        $testDrive->save();

        return back()->with('success', 'Test drive status updated successfully!');
    }
}

