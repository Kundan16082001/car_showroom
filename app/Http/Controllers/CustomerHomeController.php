<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CustomerHomeController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->get(); // Fetch all cars, latest first
        return view('home', compact('cars'));

        $cars = Car::paginate(9);//car pagination per page 9 cars
    }
}