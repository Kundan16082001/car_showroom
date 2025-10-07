<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Car;
use App\Models\TestDrive;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Show form for buying a car
     */
    public function create($testDriveId)
    {
        $testDrive = TestDrive::with('car')->findOrFail($testDriveId);

        // Only approved test drives can buy a car
        if ($testDrive->status !== 'approved') {
            return back()->with('error', 'You can only purchase a car after the test drive is approved.');
        }

        return view('purchases.create', compact('testDrive'));
    }

    /**
     * Store a new purchase
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'test_drive_id' => 'required|exists:test_drives,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $testDrive = TestDrive::findOrFail($request->test_drive_id);

        // Save purchase
        Purchase::create([
            'user_id' => $testDrive->user_id,
            'car_id' => $request->car_id,
            'test_drive_id' => $request->test_drive_id,
            'amount' => $request->amount,
            'purchase_date' => now(),
            'payment_status' => 'pending',
        ]);

        // Mark test drive as completed
        $testDrive->update(['status' => 'completed']);

        return redirect()->route('purchases.index')->with('success', 'Car purchased successfully!');
    }

    /**
     * Show logged-in user's purchases
     */
    public function myPurchases()
    {
        // FIX: `with` must use parentheses, not square brackets
        $purchases = Purchase::with('car')
            ->where('user_id', Auth::id())
            ->get();

        return view('purchases.myPurchases', compact('purchases'));
    }

    /**
     * Admin - view all purchases
     */
    public function index()
    {
        $purchases = Purchase::with(['user', 'car'])->latest()->get();
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Admin - update payment status
     */
    public function updateStatus($id, Request $request)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid',
        ]);

        // FIX: Use correct model name `Purchase` instead of `Purchases`
        $purchase = Purchase::findOrFail($id);

        $purchase->payment_status = $request->payment_status;
        $purchase->save();

        return back()->with('success', 'Payment status updated successfully');
    }
}
