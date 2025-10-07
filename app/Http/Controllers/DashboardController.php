<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Car;
use App\Models\Purchase;
use App\Models\Contact;
use App\Models\TestDrive;

class DashboardController extends Controller
{
   public function index()
{
    return view('dashboard', [
        'totalCars' => Car::count(),
        'totalTestDrives' => TestDrive::count(),
        'totalPurchases' => Purchase::count(),
        'totalUsers' => User::count(),
        'testDrives' => TestDrive::with(['user', 'car'])->latest()->take(10)->get(),
        'purchases' => Purchase::with(['user', 'car'])->latest()->take(10)->get(),
        'users' => User::latest()->take(10)->get(),
    ]);
}
}

