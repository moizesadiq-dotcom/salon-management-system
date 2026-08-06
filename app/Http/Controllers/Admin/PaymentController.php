<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Display all payments
    public function index()
    {
        $payments = Payment::with('booking.customer')
            ->latest()
            ->get();

        return view('admin.payments.index', compact('payments'));
    }


    // Create payment form
    public function create()
    {
        $bookings = Booking::with('customer')->get();

        return view('admin.payments.create', compact('bookings'));
    }


    // Save payment
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'status' => 'required',
        ]);


        Payment::create([
            'booking_id' => $request->booking_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('payments.index')
            ->with('success', 'Payment Added Successfully');
    }


    // Show single payment
    public function show(string $id)
    {
        $payment = Payment::with('booking.customer')
            ->findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }


    // Edit payment
    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);

        $books = Booking::with('customer')->get();

        return view('admin.payments.edit', compact('payment','books'));
    }


    // Update payment
    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);


        $request->validate([
            'booking_id' => 'required',
            'amount' => 'required',
            'payment_method' => 'required',
            'status' => 'required',
        ]);


        $payment->update([
            'booking_id' => $request->booking_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
        ]);


        return redirect()
            ->route('payments.index')
            ->with('success','Payment Updated Successfully');
    }


    // Delete payment
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);

        $payment->delete();


        return redirect()
            ->route('payments.index')
            ->with('success','Payment Deleted Successfully');
    }
}