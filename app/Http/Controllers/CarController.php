<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the cars.
     */
    public function index()
{
    // Check if the user is authenticated
    if (auth()->check()) {
        $user = auth()->user();

        // If the logged-in user is an admin, show the car management page
        if ($user->role === 'admin') {
            $cars = Car::latest()->get();
            return view('cars.index', compact('cars'));
        }

        // If the logged-in user is a customer, redirect to the home page
        return redirect()->route('landing')
            ->with('info', 'You are not authorized to access the admin car management page.');
    }

    // If no user is logged in, redirect to login
    return redirect()->route('login')->with('error', 'Please login to access this page.');
}


    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_brand' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_price' => 'required|numeric|min:0',
            'car_fuel_type' => 'required|string|max:255',
            'car_color' => 'required|string|max:255',
            'year' => 'required|date',
            'owner_type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Handle Image Upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
        }

        // Create Car
        Car::create([
            'car_brand' => $request->car_brand,
            'car_model' => $request->car_model,
            'car_price' => $request->car_price,
            'car_fuel_type' => $request->car_fuel_type,
            'car_color' => $request->car_color,
            'year' => $request->year,
            'owner_type' => $request->owner_type,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Car added successfully!');
    }

    /**
     * Show a single car.
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing a car.
     */
    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    /**
     * Update the specified car.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
            'car_brand' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_price' => 'required|numeric|min:0',
            'car_fuel_type' => 'required|string|max:255',
            'car_color' => 'required|string|max:255',
            'year' => 'required|date',
            'owner_type' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update Image if new uploaded
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
            $car->image = $imagePath;
        }

        $car->update([
            'car_brand' => $request->car_brand,
            'car_model' => $request->car_model,
            'car_price' => $request->car_price,
            'car_fuel_type' => $request->car_fuel_type,
            'car_color' => $request->car_color,
            'year' => $request->year,
            'owner_type' => $request->owner_type,
            'image' => $car->image,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car updated successfully!');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully!');
    }
}
